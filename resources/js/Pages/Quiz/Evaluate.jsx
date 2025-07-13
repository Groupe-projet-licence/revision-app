// 📄 resources/js/Pages/Quiz/Evaluate.jsx

import React, { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import ShowContentQuill from '@/Components/ShowContentQuill';

const stripHtml = (html) => {
    const doc = new DOMParser().parseFromString(html, 'text/html');
    return doc.body.textContent || "";
};


const Evaluate = ({ quiz }) => {
    console.log(quiz);
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
        <AuthLayouts>
            <Head title="Quiz" />
            <h1 className="text-2xl font-bold mb-6">{quiz.title}</h1>
            <form onSubmit={handleSubmit}>
                {quiz.questions.map((question, index) => (
                    <div key={question.id} className="mb-6">
                            <ShowContentQuill> {`<div style="display:flex; align-items:start;">${index + 1} ${question.question_text}</div>`}     </ShowContentQuill>

                        {question.answers.map((ans) => (
                            <div key={ans.id} className="flex items-center gap-2 mb-2 ms-4">
                                <input type={question.type === 'single' ? 'radio' : 'checkbox'}
                                    name={`question_${question.id}`}
                                    value={ans.id} checked={answers[question.id]?.includes(ans.id) || false}
                                    onChange={() => handleOptionChange(question.id, ans.id, question.type)}
                                    className="mt-1" />
                                    <ShowContentQuill>{ans.answer_text}</ShowContentQuill>
                            </div>
                        ))}
                    </div>
                ))}
                <button type="submit" className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" >Submit the quiz</button>
            </form>
        </AuthLayouts>
    );
};

export default Evaluate;
