import React, { useState } from 'react';
import { Head } from '@inertiajs/react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import HistoryCard from '@/Components/History/HistoryCard';

export default function HistoryIndex({ history }) {
  const [activeTab, setActiveTab] = useState('all'); // 'quiz', 'sheet', or 'all'
  // 🔍 Fonction de filtrage selon l’onglet actif
  const getFilteredHistory = () => {
    if (activeTab === 'all') return history;
    const filtered = {};
    for (const date in history) {
      const filteredItems = history[date].filter((item) => item.type === activeTab);
      if (filteredItems.length > 0) {
        filtered[date] = filteredItems;
      }
    }
    return filtered;
  };

  const filteredHistory = getFilteredHistory();

  return (
    <AuthLayouts>
      <Head title="History" />
      <div className="p-4 md:p-6">
        <h1 className="text-2xl font-bold mb-4">My History</h1>
        {/* ✅ Boutons de sélection Quiz / Fiche */}
        <div className="d-flex gap-3 mb-4">
          <button
            className={`btn ${activeTab === 'quiz' ? 'btn-primary' : 'btn-outline-primary'} fw-bold px-4`}
            onClick={() => setActiveTab('quiz')}
          >
            Quiz
          </button>
          <button
            className={`btn ${activeTab === 'sheet' ? 'btn-primary' : 'btn-outline-primary'} fw-bold px-4`}
            onClick={() => setActiveTab('sheet')}
          >
            Sheets
          </button>
          <button
            className={`btn ${activeTab === 'all' ? 'btn-primary' : 'btn-outline-primary'} fw-bold px-4`}
            onClick={() => setActiveTab('all')}
          >
            All
          </button>
        </div>

        {/* ✅ Affichage de l'historique filtré */}
        {Object.entries(filteredHistory).length === 0 ? (
          <p className="text-gray-600">Aucune activité trouvée pour cette catégorie.</p>
        ) : (
          Object.entries(filteredHistory).map(([date, items]) => (
            <div key={date} className="mb-5">
              <h2 className="text-lg fw-bold text-secondary mb-2">{date}</h2>
              <div className="row">
                {items.map((item) => (
                  <div className="col-md-4 mb-3" key={`${item.type}-${item.id}`}>
                    <HistoryCard item={item} />
                  </div>
                ))}
              </div>
            </div>
          ))
        )}
      </div>
    </AuthLayouts>
  );
}