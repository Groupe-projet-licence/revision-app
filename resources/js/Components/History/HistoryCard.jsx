import React from 'react';
import { Link, router } from '@inertiajs/react';

export default function HistoryCard({ item }) {
const handleDelete = () => {
if (confirm('Are you sure you want to delete this entry?')) {
router.delete(route('history.delete', [item.type, item.id]));
}
};

return (
<div className="rounded-2xl overflow-hidden shadow-md bg-white border relative">
<div className="p-4">
<div className="flex justify-between items-start mb-2">
<h3 className="text-lg font-semibold text-gray-900">
{item.title}
</h3>
<span
className={"text-xs px-2 py-1 rounded-full font-bold ${ item.type === 'quiz' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }"

}
>
{item.type === 'quiz' ? 'Quiz' : 'Sheet'}
</span>
</div>


    {item.type === 'quiz' && (
      <div className="text-sm text-blue-700 mb-3 font-semibold">
        Score: {item.score}%
      </div>
    )}

    <div className="flex justify-between gap-2 text-sm font-medium">
      <Link
        href={
          item.type === 'quiz'
            ? route('quiz.result', item.id)
            : route('sheets.show', item.id)
        }
        className="btn btn-sm btn-outline-primary my-2 me-2 fw-bold"
        style={{ fontSize: "0.9em" }}

      >
        View
      </Link>
      <button
        onClick={handleDelete}
        className="btn btn-sm btn-outline-primary my-2 me-2 fw-bold"
      style={{ fontSize: "0.9em" }}
      >
        Delete
      </button>
    </div>
  </div>
</div>
);
}
