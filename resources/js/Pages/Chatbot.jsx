import React, { useEffect, useState } from 'react';
import chatbotAnswers from '../data/chatbotAnswers';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { Head } from '@inertiajs/react';

export default function Chatbot() {
    const [question, setQuestion] = useState('');
    const [answer, setAnswer] = useState('');
    const [displayedAnswer, setDisplayedAnswer] = useState('');
    const [isTyping, setIsTyping] = useState(false);
    const [history, setHistory] = useState([]);

    const handleAsk = () => {
        if (!question.trim()) return;
        const lower = question.toLowerCase();
        const found = chatbotAnswers.find(item =>
            item.keywords.some(keyword => lower.includes(keyword))
        );

        const finalAnswer = found
            ? found.answer
            : "❌ Cette question ne concerne pas notre application ou je n'ai pas la réponse 🤕. Si tu veux savoir la liste des questions que tu peux m'adresser ecrire juste \"List\" et je te l'ai affiche 🤭";

        // Ajouter la question à l'historique
        setHistory(prev => [...prev, { type: 'user', text: question }]);
        setQuestion('');
        setAnswer(finalAnswer);
        setDisplayedAnswer('');
        setIsTyping(true);
    };

    useEffect(() => {
        if (!isTyping || !answer) return;
        let index = 0;
        const interval = setInterval(() => {
            setDisplayedAnswer(prev => prev + answer[index]);
            index++;

            if (index === answer.length) {
                clearInterval(interval);
                setIsTyping(false);
                setHistory(prev => [...prev, { type: 'bot', text: answer }]);
            }
        }, 30);

        return () => clearInterval(interval);
    }, [answer, isTyping]);

    return (
        <AuthLayouts>
            <Head>
                <title>EasyLearning bot</title>
            </Head>
            <div className="card shadow-lg border-0 p-4 mb-5" style={{ maxWidth: '650px', margin: 'auto' }}>
                <h2 className="mb-3 text-primary fw-bold">🤖 EasyLearning bot</h2>
                <div className="chat-box" style={{ maxHeight: '400px', overflowY: 'auto', marginBottom: '1rem' }}>
                    {history.map((msg, index) => (
                        <div
                            key={index}
                            className={`d-flex mb-3 ${msg.type === 'user' ? 'justify-content-end' : 'justify-content-start'}`}
                        >
                            {msg.type === 'bot' && (
                                <div className="me-2">
                                    <div
                                        className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                        style={{ width: '32px', height: '32px', fontSize: '1rem' }}
                                    >
                                        🤖
                                    </div>
                                </div>
                            )}

                            <div
                                className={`px-3 py-2 rounded-4 shadow-sm ${msg.type === 'user' ? 'bg-primary text-white' : 'bg-light text-dark'
                                    }`}
                                style={{ maxWidth: '75%' }}
                            >
                                {msg.text}
                            </div>
                        </div>
                    ))}

                    {isTyping && (
                        <div className="d-flex justify-content-start mb-2">
                            <div className="me-2">
                                <div
                                    className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                    style={{ width: '32px', height: '32px', fontSize: '1rem' }}
                                >
                                    🤖
                                </div>
                            </div>
                            <div
                                className="px-3 py-2 rounded-4 bg-light text-muted"
                                style={{ fontStyle: 'italic' }}
                            >
                                {displayedAnswer}
                                <span className="blink">|</span>
                            </div>
                        </div>
                    )}
                </div>

                <div className="d-flex">
                    <input
                        type="text"
                        className="form-control me-2"
                        value={question}
                        onChange={e => setQuestion(e.target.value)}
                        placeholder="Demander à EasyLearning bot"
                        disabled={isTyping}
                    />
                    <button
                        className="btn btn-primary"
                        onClick={handleAsk}
                        disabled={isTyping}
                    >
                        Envoyer
                    </button>
                </div>
            </div>
        </AuthLayouts>
    );
}