import React from 'react';
import HistoryCard from './HistoryCard';

export default function HistoryDateGroup({ date, items }) {
return (
<div className="mb-8">
<h2 className="text-lg font-semibold text-gray-800 mb-4">{date}</h2>
<div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
{items.map((item) => (
<HistoryCard key={'${item.type}-${item.id}'} item={item} />
))}
</div>
</div>
);
}

