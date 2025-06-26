import React from 'react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { Link } from '@inertiajs/react';

export default function HistoryIndex({ histories }) {
return (
<AuthLayouts>
    <div className="p-6">
        <h1 className="text-3xl font-bold mb-6 text-center">📚 Mon Historique de Quiz</h1>
        {histories.length === 0 ? (
            <div className="text-center text-gray-500 mt-10">
                Aucun quiz passé pour le moment.
            </div>
        ) : (
      <div className="overflow-x-auto">
        <table className="w-full text-left border-collapse">
          <thead>
            <tr className="bg-gray-100">
              <th className="py-3 px-4 border">#</th>
              <th className="py-3 px-4 border">Quiz</th>
              <th className="py-3 px-4 border">Date</th>
              <th className="py-3 px-4 border">Durée</th>
              <th className="py-3 px-4 border">Score</th>
              <th className="py-3 px-4 border">Actions</th>
            </tr>
          </thead>
          <tbody>
            {histories.map((history, index) => {
              const start = new Date(history.start_time);
              const end = new Date(history.end_time);
              const duration = Math.round((end - start) / 60000); // en minutes

              return (
                <tr key={history.id} className="hover:bg-gray-50">
                  <td className="py-2 px-4 border">{index + 1}</td>
                  <td className="py-2 px-4 border">{history.quiz?.title || 'N/A'}</td>
                  <td className="py-2 px-4 border">{new Date(history.created_at).toLocaleString()}</td>
                  <td className="py-2 px-4 border">{duration} min</td>
                  <td className="py-2 px-4 border text-blue-700 font-bold">{history.score ?? 'N/A'}%</td>
                  <td className="py-2 px-4 border">
                    <Link
                      href={route('histories.result', history.id)}
                      className="text-indigo-600 hover:underline"
                    >
                      Voir résultat
                    </Link>
                  </td>
                </tr>
              );
            })}
          </tbody>
        </table>
      </div>
    )}
  </div>
</AuthLayouts>
);
}
