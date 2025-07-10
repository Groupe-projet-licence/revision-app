import React from 'react';
import { useForm, Head } from '@inertiajs/react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import InputError from '@/Components/InputError';

export default function EditQuiz({ quiz }) {
const { data, setData, put, processing, errors } = useForm({
title: quiz.title || '',
description: quiz.description || '',
});

const handleSubmit = (e) => {
e.preventDefault();
put(route('quizzes.update', quiz.id));
};

return (
<AuthLayouts>
<Head title="Modifier le quiz" />
<div className="max-w-xl mx-auto p-6 bg-white shadow rounded">
<h1 className="text-2xl font-bold mb-6">✏️ Edit quiz</h1>


    <form onSubmit={handleSubmit} className="space-y-4">
      {/* Titre */}
      <div>
        <label className="block font-semibold mb-1">Quiz title</label>
        <input
          type="text"
          className="w-full border border-gray-300 rounded p-2"
          value={data.title}
          onChange={(e) => setData('title', e.target.value)}
        />
        <InputError message={errors.title} />
      </div>

      {/* Description */}
      <div>
        <label className="block font-semibold mb-1">Description</label>
        <textarea
          className="w-full border border-gray-300 rounded p-2"
          rows={4}
          value={data.description}
          onChange={(e) => setData('description', e.target.value)}
        />
        <InputError message={errors.description} />
      </div>

      <button
        type="submit"
        className="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700"
        disabled={processing}
      >
        💾Save
      </button>
    </form>
  </div>
</AuthLayouts>
);
}
