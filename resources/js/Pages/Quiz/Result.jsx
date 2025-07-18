import React from 'react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { Head, Link } from '@inertiajs/react';

const stripHtml = (html) => {
  const doc = new DOMParser().parseFromString(html, 'text/html');
  return doc.body.textContent || "";
};

export default function Result({ submission }) {
  const groupedAnswers = submission.answers.reduce((acc, item) => {
    const qId = item.question.id;
    if (!acc[qId]) {
      acc[qId] = {
        question: item.question,
        selected: [],
        correct: item.question.answers.filter(a => a.is_correct),
      };
    }
    acc[qId].selected.push(item.answer);
    return acc;
  }, {});

  return (
    <AuthLayouts>
      <Head title="Quiz result" />
      <div className="p-6">
        <h1 className="text-3xl font-bold mb-6 text-center"> Results of the quiz</h1>
        <div className="text-xl text-center font-semibold mb-6">
          Score : <span className="text-blue-600">{submission.score}%</span>
        </div>
        {Object.entries(groupedAnswers).map(([qId, { question, selected, correct }], index) => {
          const selectedIds = selected.map(ans => ans?.id).sort().join(',');
          const correctIds = correct.map(ans => ans?.id).sort().join(',');
          const isCorrect = selectedIds === correctIds;

          return (
            <div key={qId} className="mb-6 p-4 border rounded-lg shadow-sm bg-white">

              <p className="font-semibold mb-2"> {index + 1}. {stripHtml(question.question_text).trim()}

              </p>

              <p className="text-gray-800 font-medium">Your answer:</p>
              <ul className="list-disc ml-6 text-black">
                {selected.length > 0 ? (
                  selected.map((ans, i) => (
                    <li key={i} className={ans?.is_correct ? 'text-green-700' : 'text-red-700'}>
                      <span dangerouslySetInnerHTML={{ __html: ans?.answer_text || 'Non spécifiée' }} />
                      {!ans?.is_correct && (
                        <span className="text-sm ml-2 italic text-red-500">← Wrong answers</span>
                      )}
                    </li>
                  ))
                ) : (
                  <li className="text-red-600">No answer choosen</li>
                )}
              </ul>

              <p className="text-gray-800 mt-3 font-medium">Expected valid answers:</p>
              <ul className="list-disc ml-6 text-green-700">
                {correct.map((ans, i) => (
                  <li key={i}>
                    <span dangerouslySetInnerHTML={{ __html: ans.answer_text }} />
                  </li>
                ))}
              </ul>

              <div className={`mt-4 font-bold ${isCorrect ? 'text-green-600' : 'text-red-600'}`}>
                {isCorrect ? '✔ Bonne réponse' : '✘ Mauvaise réponse'}
              </div>
            </div>
          );
        })}


        <div className="mt-10 text-center">
          <Link href={route('quiz.evaluate', submission.quiz_id)}
            className="bg-yellow-500 text-white px-6 py-2 rounded mr-4 hover:bg-yellow-600 btn">
            Restart quiz
          </Link>

          <Link
            href={route('history.index', submission.quiz_id)}
            className="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 btn">
            View history
          </Link>
        </div>
      </div>
    </AuthLayouts>
  );
}
