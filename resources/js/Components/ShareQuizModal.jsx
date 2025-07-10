import React, { useState } from 'react';
import { router } from '@inertiajs/react';

export default function ShareQuizModal({ isOpen, onClose, quiz }) {
const [email, setEmail] = useState('');
const [status, setStatus] = useState(null);
const [loading, setLoading] = useState(false);

if (!isOpen || !quiz) return null;

const handleSubmit = (e) => {
e.preventDefault();
setStatus(null);
setLoading(true);


router.post(
  route('quizzes.share', quiz.id),
  { email },
  {
    onSuccess: () => {
      setStatus('✅ Quiz partagé avec succès');
      setEmail('');
      setLoading(false);
      setTimeout(() => {
        onClose();
        setStatus(null);
      }, 2000);
    },
    onError: () => {
      setStatus("❌ Une erreur s'est produite");
      setLoading(false);
    },
  }
);
};

return (
<div className="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div className="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 className="text-xl font-bold mb-4">Share the quiz : {quiz.title}</h2>
        <form onSubmit={handleSubmit}>
            <input
            type="email" required value={email}
            onChange={(e) => setEmail(e.target.value)}
            placeholder="Adresse e-mail du destinataire"
            className="w-full px-4 py-2 border border-gray-300 rounded mb-3"
            />
            <div className="flex justify-end gap-2">
                <button type="button" className="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300" onClick={onClose} >
                    Cancel
                </button>

                <button type="submit" className="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700" disabled={loading} >
                    {loading ? 'Envoi...' : 'Share'}
                </button>

           </div>
                 </form> {status && <p className="mt-3 text-sm text-green-600">{status}</p>}
         </div>
     </div>
        );
    }
