import React, { useState } from 'react';
import { router } from '@inertiajs/react';

const Evaluation = ({ quiz }) => {
const [answers, setAnswers] = useState({});
console.log( quiz );

const handleOptionChange = (questionId, optionId, type) => { setAnswers((prev) => {
const current = prev[questionId] || [];
    if (type === 'single') {
       return { ...prev, [questionId]: [optionId] };
      } else {
        if (current.includes(optionId)) {
            return {
                ...prev,[questionId]: current.filter((id) => id !== optionId),
            };
        } else {
            return {
                ...prev,[questionId]: [...current, optionId],
            };
        }
    }
});
};

const handleSubmit = (e) => { e.preventDefault();
    router.post(`/quizzes/${quiz.id}/submit`, {
        quiz_id: quiz.id,answers,
    });
};
return (
<div className="p-6">
    <h1 className="text-2xl font-bold mb-6">{quiz.title}</h1>
    <form onSubmit={handleSubmit}>
        {quiz.questions.map((question, index) => (
            <div key={question.id} className="mb-6">
                <p className="font-semibold mb-2">{index + 1}. {question.content}</p>
                {question.options.map((option) => (
                    <label key={option.id} className="block ml-4">
                        <input type={question.type === 'single' ? 'radio' : 'checkbox'} name={question_$`{question.id}`} value={option.id} checked={answers[question.id]?.includes(option.id) || false} onChange={() =>handleOptionChange(question.id, option.id, question.type) }/>
                        <span className="ml-2">{option.content}</span>
                        </label>
                    ))}
                    </div>
                ))}
                <button type="submit" className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" >Soumettre le quiz</button>
                </form>
                </div>
                );
            };

export default Evaluation;
