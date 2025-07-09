import React from 'react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { Head, Link } from '@inertiajs/react';

export default function History({ submissions }) {
  return (
    <AuthLayouts>
      <Head>
        <title>Historique Quiz</title>
      </Head>
      <div className="p-6">
        <h1 className="text-2xl font-bold mb-6">History of Past Quizzes</h1>

        {submissions.length === 0 ? (
          <p>No attempts recorded yet.</p>
        ) : (
          <table className="min-w-full table-auto border border-gray-200 shadow-md rounded">
            <thead className="bg-gray-100">
              <tr>
                <th className="p-3">#</th>
                <th className="p-3 text-left">Titre du Quiz</th>
                <th className="p-3">Score</th>
                <th className="p-3">Date</th>
                <th className="p-3">Actions</th>
              </tr>
            </thead>
            <tbody>
              {submissions.map((s, index) => (
                <tr key={s.id} className="border-t">
                  <td className="p-3">{index + 1}</td>
                  <td className="p-3">{s.quiz?.title || 'Quiz supprimé'}</td>
                  <td className="p-3 text-center">{s.score}</td>
                  <td className="p-3">{new Date(s.created_at).toLocaleDateString()}</td>
                  <td className="p-3 text-center">
                    <Link
                      href={route('quiz.result', s.id)}
                      className="text-blue-600 hover:underline"
                    >
                      Voir Résultat
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
