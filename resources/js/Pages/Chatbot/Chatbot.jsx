import React, { useEffect, useState, useRef } from 'react';
import chatbotAnswers from './data/chatbotAnswers';
import suggestions from './data/suggestion';
import AuthLayouts from '@/Layouts/AuthLayouts';
import { Head } from '@inertiajs/react';
import Fuse from 'fuse.js';
import './chatbot.css';

export default function Chatbot() {
    // Gérer l'état de la langue localement
    const [language, setLanguage] = useState(() => {
        return localStorage.getItem('language') || 'en';
    });

    const [question, setQuestion] = useState('');
    const [answer, setAnswer] = useState('');
    const [displayedAnswer, setDisplayedAnswer] = useState('');
    const [isTyping, setIsTyping] = useState(false);
    const [history, setHistory] = useState([]);
    const [hasStarted, setHasStarted] = useState(false);
    const chatBoxRef = useRef(null);

    // Messages de bienvenue spécifiques à la langue
    const welcomeMessages = {
        en: 'Hello 👋, I am EasyLearning Bot! How can I help you today?',
        fr: 'Bonjour 👋, je suis EasyLearning Bot ! Comment puis-je t\'aider aujourd\'hui ?'
    };

    // Sauvegarder la langue dans localStorage à chaque changement
    useEffect(() => {
        localStorage.setItem('language', language);
    }, [language]);

    // Initialiser Fuse.js avec les réponses de la langue actuelle
    const fuse = new Fuse(chatbotAnswers[language], {
        keys: ['keywords'],
        threshold: 0.4,
    });

    // Charger l'historique depuis localStorage au montage
    useEffect(() => {
        const savedHistory = localStorage.getItem('chatHistory');
        if (savedHistory) {
            setHistory(JSON.parse(savedHistory));
            setHasStarted(true);
        }
    }, []);

    // Enregistrer l'historique dans localStorage lors des changements
    useEffect(() => {
        localStorage.setItem('chatHistory', JSON.stringify(history));
    }, [history]);

    // Faire défiler jusqu'en bas de la boîte de chat
    useEffect(() => {
        if (chatBoxRef.current) {
            chatBoxRef.current.scrollTop = chatBoxRef.current.scrollHeight;
        }
    }, [history, isTyping]);

    const handleAsk = (custom = null) => {
        const userQuestion = custom ?? question;
        if (!userQuestion.trim()) return;
        if (!hasStarted) setHasStarted(true);

        const lower = userQuestion.toLowerCase();
        const results = fuse.search(lower);
        const found = results.length > 0 ? results[0].item : null;

        const finalAnswer = found
            ? found.answer
            : language === 'en'
                ? "<strong>❌ This question is not related to our application, or I don't have the answer 🤕.</strong><br/>You can type \"List\" to see the possible questions 🤭."
                : "<strong>❌ Cette question ne concerne pas notre application ou je n'ai pas la réponse 🤕.</strong><br/>Tu peux écrire « List » pour voir les questions possibles 🤭.";
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
                <div style={{display:'flex', justifyContent:'space-between'}}>
                    <h2 className="mb-3 text-primary fw-bold">🤖 EasyLearning Bot</h2>
                    {/* Sélecteur de langue */}
                    <div className="d-flex justify-content-end mb-3">
                        <select
                            value={language}
                            onChange={(e) => {
                                setLanguage(e.target.value);
                                setHistory([]);
                                setHasStarted(false);
                                localStorage.removeItem('chatHistory');
                            }}
                            style={{ borderRadius: '10px' }}
                            className="form-select w-auto"
                            aria-label="Sélectionner la langue"
                        >
                            <option value="en">English</option>
                            <option value="fr">Français</option>
                        </select>
                    </div>
                </div>

                {/* Bouton pour effacer le chat */}
                <div className="d-flex justify-content-end mb-2">
                    <button
                        className="btn btn-outline-danger btn-sm"
                        onClick={() => {
                            setHistory([]);
                            setHasStarted(false);
                            localStorage.removeItem('chatHistory');
                        }}
                    >
                        {language === 'en' ? 'Clear Chat' : 'Effacer le chat'}
                    </button>
                </div>
                <div
                    className="chat-box"
                    ref={chatBoxRef}
                    style={{ maxHeight: '400px', overflowY: 'auto', marginBottom: '1rem' }}
                    role="log"
                    aria-live="polite"
                >
                    {/* Message de bienvenue */}
                    {!hasStarted && (
                        <div className="d-flex justify-content-start mb-3">
                            <div className="me-2">
                                <div className="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style={{ width: '32px', height: '32px' }}>
                                    🤖
                                </div>
                            </div>
                            <div className="px-3 py-2 rounded-4 bg-light text-dark">
                                {welcomeMessages[language]}
                            </div>
                        </div>
                    )}
                    {/* Suggestions */}
                    {!hasStarted && (
                        <div className="mt-3">
                            <strong className="mb-2 d-block" style={{ fontSize: '1.5rem', textAlign: 'center' }}>
                                {language === 'en' ? '💡 Suggestions:' : '💡 Suggestions :'}
                            </strong>
                            <div className="d-flex flex-wrap gap-2" style={{ justifyContent: 'center', alignItems: 'center' }}>
                                {suggestions[language].map((s, i) => (
                                    <button
                                        key={i}
                                        className="btn btn-outline-secondary btn-sm"
                                        onClick={() => handleAsk(s)}
                                    >
                                        {s}
                                    </button>
                                ))}
                            </div>
                        </div>
                    )}
                    {/* Historique */}
                    {history.map((msg, index) => (
                        <div
                            key={index}
                            className={`d-flex mb-3 ${msg.type === 'user' ? 'justify-content-end' : 'justify-content-start'}`}
                        >
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
                    {/* Animation de saisie */}
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
                {/* Champ de saisie */}
                <div className="d-flex mb-2">
                    <input
                        type="text"
                        className="form-control me-2"
                        value={question}
                        onChange={e => setQuestion(e.target.value)}
                        onKeyDown={e => e.key === 'Enter' && !isTyping && handleAsk()}
                        placeholder={language === 'en' ? 'Ask EasyLearning Bot' : 'Poser une question à EasyLearning Bot'}
                        disabled={isTyping}
                        aria-label={language === 'en' ? 'Ask a question to EasyLearning Bot' : 'Poser une question à EasyLearning Bot'}
                    />
                    <button
                        className="btn btn-primary"
                        onClick={() => handleAsk()}
                        disabled={isTyping}
                        aria-label={language === 'en' ? 'Send question' : 'Envoyer la question'}
                    >
                        {language === 'en' ? 'Send' : 'Envoyer'}
                    </button>
                </div>
            </div>
        </AuthLayouts>
    );
}