import React from 'react';
<<<<<<< HEAD
import AuthLayouts from '@/Layouts/AuthLayouts';
import { Link } from '@inertiajs/react';

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
        <div className="p-6">
            <h1 className="text-3xl font-bold mb-6 text-center"> Résultat du Quiz</h1>
            <div className="text-xl text-center font-semibold mb-6">
                 Score : <span className="text-blue-600">{submission.score}%</span>
                 </div>
                {Object.entries(groupedAnswers).map(([qId, { question, selected, correct }], index) => {
      const selectedIds = selected.map(ans => ans?.id).sort().join(',');
      const correctIds = correct.map(ans => ans?.id).sort().join(',');
      const isCorrect = selectedIds === correctIds;

      return (
        <div key={qId} className="mb-6 p-4 border rounded-lg shadow-sm bg-white">
          <p className="font-semibold mb-2 text-lg">
            {index + 1}. {question.question_text}
          </p>

          <p className="text-gray-800 font-medium"> Tes réponses :</p>
          <ul className="list-disc ml-6 text-black">
            {selected.length > 0 ? (
              selected.map((ans, i) => (
                <li key={i} className={ans?.is_correct ? 'text-green-700' : 'text-red-700'}>
                  <span dangerouslySetInnerHTML={{ __html: ans?.answer_text || 'Non spécifiée' }} />
                  {!ans?.is_correct && (
                    <span className="text-sm ml-2 italic text-red-500">← Mauvaise réponse</span>
                  )}
                </li>
              ))
            ) : (
              <li className="text-red-600">Aucune réponse donnée</li>
            )}
          </ul>

          <p className="text-gray-800 mt-3 font-medium">Bonnes réponses attendues :</p>
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
        className="bg-yellow-500 text-white px-6 py-2 rounded mr-4 hover:bg-yellow-600">
        🔁 Recommencer ce quiz
      </Link>

      <Link
        href={route('sheets.index')} // à adapter selon la route vers les fiches
        className="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
        📄 Voir une fiche associée
      </Link>
    </div>
  </div>
</AuthLayouts>
);
}
=======

const Result = ({ submission }) => {
return (
<div className="p-6">
    <h1 className="text-3xl font-bold mb-4">Résultat du Quiz</h1>
    <p className="mb-6 text-lg font-semibold">Score : {submission.score} / {submission.answers.length}</p>  {submission.answers.map((answer, index) => (
        <div key={index} className="mb-4 border-b pb-4">
            <p className="font-semibold"> {index + 1}. {answer.question.content}</p>
            <p className="mt-1">
                <span className="text-gray-700">Ta réponse :</span>{' '}{answer.option ? answer.option.content : 'Non répondue'}</p>{answer.option?.is_correct ? (
                    <span className="text-green-600 font-semibold">✔ Bonne réponse</span>
                ) : (
                <span className="text-red-600 font-semibold">✘ Mauvaise réponse</span>
                 )}
                  </div>
                ))}
                </div>
                );
            };

export default Result;
>>>>>>> 5717658 (passer un quiz)
