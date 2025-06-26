import React from 'react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { Link } from '@inertiajs/react';

export default function Result({ history, corrections }) {
const grouped = history.quiz.questions.map((question, index) => {
const corr = corrections[question.id] || {};
const selectedIds = corr.selected || [];
const correctIds = corr.correct || [];
const score = corr.score || 0;

const isCorrect = JSON.stringify([...selectedIds].sort()) === JSON.stringify([...correctIds].sort());
return {
     index,
      question,
       selected: question.answers.filter(a => selectedIds.includes(a.id)),
        correct: question.answers.filter(a => correctIds.includes(a.id)),
        score,
         isCorrect,
        };
    });

    return (
    <AuthLayouts>
        <div className="p-6">
            <h1 className="text-3xl font-bold mb-6 text-center">Résultat du Quiz : {history.quiz.title}</h1>
             <div className="text-xl text-center font-semibold mb-6">
                 Score global : <span className="text-blue-600">{history.score}%</span>
             </div>


             {grouped.map(({ index, question, selected, correct, score, isCorrect }) => (
                 <div key={question.id} className="mb-6 p-4 border rounded-lg shadow-sm bg-white">
                    <p className="font-semibold mb-2 text-lg">
                         {index + 1}. {question.question_text}
                     </p>

        <p className="text-gray-800 font-medium">Tes réponses :</p>
        <ul className="list-disc ml-6">
          {selected.length > 0 ? (
            selected.map((ans, i) => (
              <li key={i} className={ans.is_correct ? 'text-green-700' : 'text-red-700'}>
                <span dangerouslySetInnerHTML={{ __html: ans.answer_text }} />
                {!ans.is_correct && (
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
          {isCorrect ? '✔ Réponse exacte' : `✘ Inexacte - Score partiel : ${score}%`}
        </div>
      </div>
    ))}

    <div className="mt-10 text-center space-x-4">
      <Link
        href={route('quiz.evaluate', history.quiz_id)}
        className="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600"
      >
        🔁 Repasser le quiz
      </Link>

      <Link
        href={route('sheets.index')} // Adapte cette route à celle de tes fiches
        className="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700"
      >
        📄 Voir les fiches associées
      </Link>
    </div>
  </div>
</AuthLayouts>
);
}
