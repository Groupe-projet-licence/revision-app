// 📄 resources/js/Pages/Quiz/Evaluate.jsx

import React, { useState } from 'react';
import { router } from '@inertiajs/react';

const Evaluate = ({ quiz }) => {
const [answers, setAnswers] = useState({});

const handleOptionChange = (questionId, answerId, type) => {
    setAnswers((prev) => {
        const current = prev[questionId] || [];
        if (type === 'single') {
            return { ...prev, [questionId]: [answerId] };
        } else {
            if (current.includes(answerId)) {
                return {
                    ...prev,
                    [questionId]: current.filter((id) => id !== answerId),
                };
            } else {
                return {
                    ...prev,
                    [questionId]: [...current, answerId],
                };
            }
        }
    });
};

const handleSubmit = (e) => {
    e.preventDefault();
    router.post(route('quiz.submit', quiz.id), {
        quiz_id: quiz.id,
        answers,
    });
};

return (
<div className="p-6">
    <h1 className="text-2xl font-bold mb-6">{quiz.title}</h1>
    <form onSubmit={handleSubmit}>
        {quiz.questions.map((question, index) => (
             <div key={question.id} className="mb-6">
                 <p className="font-semibold mb-2">{index + 1}. {question.question_text}

                 </p>
                 {question.answers.map((ans) => (
                     <label key={ans.id} className="block ml-4">
                         <input type={question.type === 'single' ? 'radio' : 'checkbox'}
                          name={'question_${question.id}'}
                          value={ans.id} checked={answers[question.id]?.includes(ans.id) || false}
                          onChange={() =>
                          handleOptionChange(question.id, ans.id, question.type)}
                          />
                          <span className="ml-2"dangerouslySetInnerHTML={{ __html: ans.answer_text  }}/>
                         </label>
                     ))}
                </div>
            ))}
            <button type="submit" className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" >Soumettre le quiz</button>
            </form>
             </div>
              );
             };

export default Evaluate;
