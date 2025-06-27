import React from 'react';

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
