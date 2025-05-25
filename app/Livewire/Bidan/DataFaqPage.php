<?php

namespace App\Livewire\Bidan;

use App\Models\FaqModel;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataFaqPage extends Component
{
    public $faqs;
    public $question, $answer;
    public $selectedFaqId = null;

    public function mount()
    {
        $this->loadFaqs();
    }

    protected $messages = [
        'question.required' => 'Pertanyaan wajib diisi.',
        'question.string' => 'Pertanyaan harus berupa teks.',
        'question.max' => 'Pertanyaan maksimal 255 karakter.',
        'question.unique' => 'Pertanyaan sudah terdaftar.',
        'answer.required' => 'Jawaban wajib diisi.',
        'answer.string' => 'Jawaban harus berupa teks.',
        'answer.max' => 'Jawaban maksimal 1000 karakter.',
    ];

    protected function rules()
    {
        return [
            'question' => [
                'required',
                'string',
                'max:255',
                $this->selectedFaqId
                    ? 'unique:faq,question,' . $this->selectedFaqId
                    : 'unique:faq,question'
            ],
            'answer' => 'required|string|max:1000',
        ];
    }

    public function loadFaqs()
    {
        $this->faqs = FaqModel::all();
    }

    public function simpan()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();

            if ($this->selectedFaqId) {
                // Update
                FaqModel::where('id', $this->selectedFaqId)->update([
                    'question' => $this->question,
                    'answer' => $this->answer,
                ]);
                session()->flash('success', 'FAQ berhasil diperbarui.');
            } else {
                // Create
                FaqModel::create([
                    'question' => $this->question,
                    'answer' => $this->answer,
                ]);
                session()->flash('success', 'FAQ berhasil ditambahkan.');
            }

            DB::commit();
            $this->resetForm();
            $this->loadFaqs();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $faq = FaqModel::findOrFail($id);
        $this->selectedFaqId = $id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
    }

    public function delete($id)
    {
        try {
            FaqModel::where('id', $id)->delete();
            session()->flash('success', 'FAQ berhasil dihapus.');
            $this->loadFaqs();
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus FAQ: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['question', 'answer', 'selectedFaqId']);
    }

    public function render()
    {
        return view('livewire.bidan.data-faq-page');
    }
}
