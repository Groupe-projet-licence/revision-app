import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AuthLayouts from '@/Layouts/AuthLayouts';

export default function Index({ ratings, average }) {
const [hover, setHover] = useState(0);
const { data, setData, post, processing, reset } = useForm({
stars: 0,
comment: '',
});

const submit = (e) => {
e.preventDefault();
post(route('ratings.store'), {
onSuccess: () => reset(),
});
};

return (
<AuthLayouts>
<Head title="Rate Us" />


  <div className="max-w-4xl mx-auto mt-8 p-6 bg-white shadow rounded">
    <h2 className="text-2xl font-bold text-blue-700 mb-4">Rate Our Application</h2>

    <p className="text-sm text-gray-600 mb-4">Average Rating:  <span  className="text-black">★</span> {average} / 5</p>

    <form onSubmit={submit} className="space-y-4 mb-6">
      <div className="flex gap-1 text-2xl text-blue-500">
        {[1, 2, 3, 4, 5].map((i) => (
          <button
            key={i}
            type="button"
            onClick={() => setData('stars', i)}
            onMouseEnter={() => setHover(i)}
            onMouseLeave={() => setHover(0)}
            className="transition"
          >
            <i className={`bi ${i <= (hover || data.stars) ? 'bi-star-fill' : 'bi-star'} cursor-pointer`}></i>
          </button>
        ))}
      </div>

      <textarea
        className="form-control w-full p-3 border rounded"
        placeholder="Write a comment (optional)"
        value={data.comment}
        onChange={(e) => setData('comment', e.target.value)}
        rows="3"
      ></textarea>

      <button
        className="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded"
        disabled={processing || data.stars === 0}
      >
        Submit
      </button>
    </form>

    <h3 className="text-xl font-bold text-gray-800 mb-2">Latest Reviews</h3>
<div className="space-y-3">
  {ratings.map((r) => (
    <div key={r.id} className="p-3 bg-blue-50 border border-blue-200 rounded shadow-sm">
      <div className="flex items-center text-lg mb-1">
        {Array.from({ length: r.stars }).map((_, i) => (
          <span key={i} className="text-black">★</span>
        ))}
        <span className="text-sm text-gray-600 ml-2">
          {r.user?.name || 'Anonymous'} — {new Date(r.created_at).toLocaleDateString()}
        </span>
      </div>
      <p className="text-gray-800">{r.comment}</p>
    </div>
  ))}
</div>


  </div>
</AuthLayouts>
);
}
