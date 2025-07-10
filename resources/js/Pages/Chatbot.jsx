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
    const [hasStarted, setHasStarted] = useState(false); // nouvelle variable

    const suggestions = [
        'Comment créer une fiche ?',
        'C’est quoi un quiz ?',
        'Qu’est-ce que la révision intelligente ?',
        'Comment changer la langue du bot ?',
        'Qui est EasyLearning Bot ?'
    ];

    const handleAsk = (custom = null) => {
        const userQuestion = custom ?? question;
        if (!userQuestion.trim()) return;
        if (!hasStarted) setHasStarted(true); // marquer que le chat a commencé

        const lower = userQuestion.toLowerCase();
        const found = chatbotAnswers.find(item =>
            item.keywords.some(keyword => lower.includes(keyword))
        );

        const finalAnswer = found
            ? found.answer
            : "<strong>❌ Cette question ne concerne pas notre application ou je n'ai pas la réponse 🤕.</strong><br/>Tu peux écrire « List » pour voir les questions possibles 🤭";

        setHistory(prev => [...prev, { type: 'user', text: userQuestion }]);
        setQuestion('');
        setAnswer(finalAnswer);
        setDisplayedAnswer('');
        setIsTyping(true);
    };

    useEffect(() => {
        if (!isTyping || !answer) return;
        let index = -1;
        const interval = setInterval(() => {
            setDisplayedAnswer(prev => prev + answer[index]);
            index++;
            if (index === answer.length) {
                clearInterval(interval);
                setIsTyping(false);
                setHistory(prev => [...prev, { type: 'bot', text: answer }]);
            }
        }, 20);

        return () => clearInterval(interval);
    }, [answer, isTyping]);

    return (
        <AuthLayouts>
            <Head>
                <title>Bot</title>
            </Head>
            <div className="card shadow-lg border-0 p-4 mb-5" style={{ maxWidth: '650px', margin: 'auto' }}>
                <h2 className="mb-3 text-primary fw-bold">🤖 EasyLearning bot</h2>
                <div className="chat-box" style={{ maxHeight: '400px', overflowY: 'auto', marginBottom: '1rem' }}>
                    {/* Message d'accueil */}
                    {!hasStarted && (
                        <div className="d-flex justify-content-start mb-3">
                            <div className="me-2">
                                <div className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style={{ width: '32px', height: '32px' }}>
                                    🤖
                                </div>
                            </div>
                            <div className="px-3 py-2 rounded-4 bg-light text-dark">
                                Bonjour 👋, je suis EasyLearning Bot ! Comment puis-je vous aider ?
                            </div>
                        </div>
                    )}

                    {/* Suggestions (cachées après première question) */}
                    {!hasStarted && (
                        <div className="mt-3">
                            <strong className="mb-2 d-block" style={{ fontSize:'1.5rem', textAlign: 'center'}}>💡 Suggestions :</strong>
                            <div className="d-flex flex-wrap gap-2" style={{justifyContent: 'center', alignItems: 'center'}}>
                                {suggestions.map((s, i) => (
                                    <button key={i} className="btn btn-outline-secondary btn-sm" onClick={() => handleAsk(s)}>
                                        {s}
                                    </button>
                                ))}
                            </div>
                        </div>
                    )}

                    {/* Historique */}
                    {history.map((msg, index) => (
                        <div key={index} className={`d-flex mb-3 ${msg.type === 'user' ? 'justify-content-end' : 'justify-content-start'}`}>
                            {msg.type === 'bot' && (
                                <div className="me-2">
                                    <div className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style={{ width: '32px', height: '32px' }}>
                                        🤖
                                    </div>
                                </div>
                            )}
                            <div
                                className={`px-3 py-2 rounded-4 shadow-sm ${msg.type === 'user' ? 'bg-primary text-white' : 'bg-light text-dark'}`}
                                style={{ maxWidth: '75%' }}
                                dangerouslySetInnerHTML={{ __html: msg.text }}
                            />
                        </div>
                    ))}

                    {isTyping && (
                        <div className="d-flex justify-content-start mb-2">
                            <div className="me-2">
                                <div className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style={{ width: '32px', height: '32px' }}>
                                    🤖
                                </div>
                            </div>
                            <div className="px-3 py-2 rounded-4 bg-light text-muted" style={{ fontStyle: 'italic' }}>
                                {displayedAnswer}
                                <span className="blink">|</span>
                            </div>
                        </div>
                    )}
                </div>

                {/* Champ de question */}
                <div className="d-flex mb-2">
                    <input
                        type="text"
                        className="form-control me-2"
                        value={question}
                        onChange={e => setQuestion(e.target.value)}
                        placeholder="Ask EasyLearning bot"
                        disabled={isTyping}
                    />
                    <button className="btn btn-primary" onClick={() => handleAsk()} disabled={isTyping}>
                        Envoyer
                    </button>
                </div>
            </div>
        </AuthLayouts>
    );
}