import React from 'react';
import { Head } from '@inertiajs/react';
import AuthLayouts from '@/Layouts/AuthLayouts';
import HistoryCard from '@/Components/History/HistoryCard';

export default function HistoryIndex({ history }) {
return (
<AuthLayouts>
<Head title="History" />
<div className="p-4 md:p-6">
<h1 className="text-2xl font-bold mb-6">My History</h1>


    {Object.entries(history).length === 0 ? (
      <p className="text-gray-600">No activity found.</p>
    ) : (
      Object.entries(history).map(([date, items]) => (
        <div key={date} className="mb-8">
          <h2 className="text-lg font-semibold text-gray-700 mb-4">
            {date}
          </h2>
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            {items.map((item) => (
              <HistoryCard key={`${item.type}-${item.id}`} item={item} />
            ))}
          </div>
        </div>
      ))
    )}
  </div>
</AuthLayouts>
);
}
