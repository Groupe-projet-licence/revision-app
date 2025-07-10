import React from 'react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { Link } from '@inertiajs/react';

export default function QuestionIndex({ questions }) {
    return (
    <AuthLayouts>
        <div className="p-6">
            <div className="flex justify-between items-center mb-6">
                <h1 className="text-2xl font-bold">List of questions</h1>
                <Link href={route('questions.create')}className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                ➕ New question
                </Link>
            </div>

            {questions.length === 0 ? (
                <p className="text-gray-500">No question registered.</p>
            ) : (

            <table className="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                 <thead>
                    <tr className="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <th className="py-3 px-4 border-b">#</th>
                        <th className="py-3 px-4 border-b">Intitulé</th>
                        <th className="py-3 px-4 border-b">Type</th>
                        <th className="py-3 px-4 border-b">Quiz</th>
                        <th className="py-3 px-4 border-b">Actions</th>
                    </tr>
               </thead>
           <tbody>
          {questions.map((question, index) => (
            <tr key={question.id} className="border-b text-sm">
              <td className="py-2 px-4">{index + 1}</td>
              <td className="py-2 px-4" dangerouslySetInnerHTML={{ __html: question.question_text }} />
              <td className="py-2 px-4 capitalize">{question.type}</td>
              <td className="py-2 px-4">{question.quiz?.title || 'N/A'}</td>
              <td className="py-2 px-4">
                <Link
                  href={route('questions.edit', question.id)}
                  className="text-blue-600 hover:underline mr-2" >
                  Edit
                </Link>
                <Link
                  href={route('questions.show', question.id)}
                  className="text-green-600 hover:underline mr-2">
                   View
                </Link>
                <Link
                  href={route('questions.destroy', question.id)}
                  className="text-red-600 hover:underline mr-2">
                  Delete
                </Link>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    )}
  </div>
</AuthLayouts>
);
}
