import React, { useState } from 'react';
import chatbotAnswers from './Chatbot/data/chatbotAnswers';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { useEffect } from 'react';

export default function Chatbot() {
    const [question, setQuestion] = useState('');
    const [answer, setAnswer] = useState('');
    const [displayedAnswer, setDisplayedAnswer] = useState('');
    const [isTyping, setIsTyping] = useState(false);

    const handleAsk = () => {
        setDisplayedAnswer('');
        setIsTyping(true);
        const lower = question.toLowerCase();
        const found = chatbotAnswers.find(item =>
            item.keywords.some(keyword => lower.includes(keyword))
        );

        if (found) {
            setAnswer(found.answer);
        } else {
            setAnswer("❌ Cette question ne concerne pas notre application ou je n'ai pas la réponse.");
        }
    };

    //Effet machine a ecrire 
    useEffect(() => {
        if (!isTyping || !answer) return;

        let index = -1;
        const interval = setInterval(() => {
            setDisplayedAnswer(prev => prev + answer[index]);
            index++;

            if (index === answer.length - 1) {
                clearInterval(interval);
                setIsTyping(false);
            }
        }, 30); //Vitesse ecriture en ms

        return () => clearInterval(interval);
    }, [answer, isTyping]);

    return (
        <AuthLayouts>
            <div className="card p-3 mb-4">
                <h5>🤖 Chatbot - EasyLearning</h5>
                <input
                    type="text"
                    className="form-control my-2"
                    value={question}
                    onChange={e => setQuestion(e.target.value)}
                    placeholder="Pose ta question sur EasyLearning..."
                />
                <button className="btn btn-primary" onClick={handleAsk}>{isTyping ? "⌛ Réponse en cours ..." : "Poser la question"}</button>
                {displayedAnswer && (
                    <div className="alert alert-info mt-3">
                        {displayedAnswer}
                    </div>
                )}
            </div>
        </AuthLayouts>
    );
}  