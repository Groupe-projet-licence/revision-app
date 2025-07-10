import React, { useState } from 'react';
import { useForm, Link, Head } from '@inertiajs/react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import QuillEditor from '@/Components/QuillEditor';
import QuillEditorSmall from "@/Components/QuillEditorSmall";
import InputError from '@/Components/InputError';

const stripHtml = (html) => {
    const doc = new DOMParser().parseFromString(html, 'text/html');
    return doc.body.textContent || "";
};

export default function EditQuestion({ question, quizzes }) {
  const { data, setData, put, errors } = useForm({
    question_text: question.question_text || '',
    type: question.type || 'single',
    quiz_id: question.quiz_id || '',
    answers: question.answers || [],
  });

  const [newAnswer, setNewAnswer] = useState('');

  const handleAnswerChange = (index, field, value) => {
    const updated = [...data.answers];
    updated[index][field] = value;
    setData('answers', updated);
  };

  const handleAddAnswer = () => {
    const trimmed = newAnswer.trim();
    if (trimmed !== '') {
      setData('answers', [
        ...data.answers,
        { answer_text: trimmed, is_correct: false },
      ]);
      setNewAnswer('');
    }
  };

  const handleRemoveAnswer = (index) => {
    const updated = [...data.answers];
    updated.splice(index, 1);
    setData('answers', updated);
  };

  const submit = (e) => {
    e.preventDefault();
    put(route('questions.update', question.id));
  };

  return (
    <AuthLayouts>
      <Head title="Edit Question" />
      <div className="max-w-3xl mx-auto">
        <h1 className="text-2xl font-bold mb-6">✏️ Edit Question</h1>
        <form onSubmit={submit} className="space-y-5">

          {/* QUIZ SELECTION */}
          <div>
            <label className="block mb-1 font-semibold">Quiz</label>
            <select
              className="w-full border border-gray-300 rounded p-2"
              value={data.quiz_id}
              onChange={(e) => setData('quiz_id', e.target.value)}
            >
              <option value="">-- Select a quiz --</option>
              {quizzes.map((quiz) => (
                <option key={quiz.id} value={quiz.id}>
                  {quiz.title}
                </option>
              ))}
            </select>
            <InputError message={errors.quiz_id} />
          </div>

          {/* QUESTION TEXT */}
          <div>
            <label className="block mb-1 font-semibold">Question Text</label>
            <QuillEditor
              value={data.question_text}
              onChange={(value) => setData('question_text', value)}
            />
            <InputError message={errors.question_text} />
          </div>

          {/* TYPE */}
          <div>
            <label className="block mb-1 font-semibold">Question Type</label>
            <select
              className="w-full border border-gray-300 rounded p-2"
              value={data.type}
              onChange={(e) => setData('type', e.target.value)}
            >
              <option value="single">Single choice</option>
              <option value="multiple">Multiple choice</option>
            </select>
            <InputError message={errors.type} />
          </div>

          {/* ANSWERS */}
          <div>
            <label className="block mb-2 font-semibold">Answers</label>
            {data.answers.map((answer, index) => (
              <div key={index} className="flex items-center gap-2 mb-2">
                <input
                  type="text"
                  value={answer.answer_text}
                  onChange={(e) =>
                    handleAnswerChange(index, 'answer_text', e.target.value)
                  }
                  className="flex-1 border border-gray-300 rounded p-2"
                  placeholder={`Answer ${index + 1}`}
                />
                <label className="flex items-center gap-1">
                  <input
                    type="checkbox"
                    checked={answer.is_correct}
                    onChange={(e) =>
                      handleAnswerChange(index, 'is_correct', e.target.checked)
                    }
                  />
                  Correct
                </label>
                <button
                  type="button"
                  onClick={() => handleRemoveAnswer(index)}
                  className="text-red-600"
                >
                  ✖
                </button>
              </div>
            ))}

            {/* NEW ANSWER INPUT */}
            <div className="flex gap-2 mt-2">
              <input
                type="text"
                value={newAnswer}
                onChange={(e) => setNewAnswer(e.target.value)}
                placeholder="New answer"
                className="flex-1 border border-gray-300 rounded p-2"
              />
              <button
                type="button"
                onClick={handleAddAnswer}
                className="px-4 bg-blue-600 text-white rounded hover:bg-blue-700"
              >
                ➕ Add
              </button>
            </div>
          </div>

          {/* SUBMIT */}
          <button
            type="submit"
            className="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700"
          >
            💾 Save
          </button>
        </form>
      </div>
    </AuthLayouts>
  );
}
