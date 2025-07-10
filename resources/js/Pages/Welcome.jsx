import React from 'react';
import { Link, usePage } from '@inertiajs/react';

export default function Welcome() {
  const { auth } = usePage().props;

  const features = [
    {
      icon: '📝',
      title: 'Create Notes',
      text: 'Organize your learning with a rich content editor (text, images, colors).',
      requiresAuth: true,
    },
    {
      icon: '🧠',
      title: 'Interactive Quizzes',
      text: 'Test your knowledge with single or multiple choice questions.',
    },
    {
      icon: '📊',
      title: 'Progress Tracking',
      text: 'Analyze your results with statistics and a personalized dashboard.',
    },
    {
      icon: '💡',
      title: 'Smart Review',
      text: 'Use spaced repetition to retain information longer.',
    },
    {
      icon: '📚',
      title: 'Flashcards & Notes',
      text: 'Review quickly with an interactive flashcard system.',
    },
    {
      icon: '🤝',
      title: 'Sharing & Collaboration',
      text: 'Collaborate with other students and share your best notes.',
    },
  ];

  const handleProtectedClick = (e) => {
    e.preventDefault();
    window.location.href = route('register');
  };

  return (
    <div className="w-full min-h-screen bg-white text-gray-800 font-serif">
      {/* Navbar */}
      <header className="sticky top-0 z-50 w-full bg-blue-700 text-white shadow-md py-4 px-8 flex justify-between items-center">
        <h1 className="text-2xl font-extrabold tracking-wide">EasyLearning</h1>
        <div className="space-x-4">
          <Link href={route('login')} className="hover:underline font-medium">Login</Link>
          <Link href={route('register')} className="bg-white text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-100 font-semibold transition">Sign Up</Link>
        </div>
      </header>
      <section className="bg-gradient-to-b from-blue-100 to-white px-6 py-16">
        <h2 className="text-5xl font-bold text-blue-800 text-center mb-12">Welcome to EasyLearning 📘</h2>
        <div className="flex flex-col md:flex-row items-center justify-center gap-10 max-w-6xl mx-auto">
          <div className="md:w-1/2">
            <img
              src="/images/photo.png"
              alt="Online Learning"
              className="w-full max-w-md mx-auto rounded-xl shadow-lg"
            />
          </div>
          <div className="md:w-1/2 text-center md:text-left">
            <p className="text-lg sm:text-xl text-gray-800 leading-8">
              <span className="font-semibold text-blue-700">EasyLearning</span> is the perfect platform to learn and revise effectively.
              Access clear and concise courses on a variety of subjects, test your knowledge with interactive quizzes, and track your progress in real time.
              Study at your own pace, wherever you are.
            </p>
          </div>
        </div>
      </section>
      <section className="bg-white py-10 px-6">
        <div className="max-w-6xl mx-auto text-center">
          <h3 className="text-3xl sm:text-4xl font-bold mb-10 text-blue-800">Try it now</h3>
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            {features.map((f, i) => (
              <div key={i} className="bg-blue-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <div className="text-5xl mb-4">{f.icon}</div>
                <h4 className="text-xl font-semibold text-blue-700 mb-2">{f.title}</h4>
                <p className="text-gray-600 text-sm mb-6 leading-relaxed">{f.text}</p>
                <button
                  onClick={handleProtectedClick}
                  className="text-sm text-white bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 font-medium transition"
                >
                  Access
                </button>
              </div>
            ))}
          </div>
        </div>
      </section>
      <section className="bg-blue-50 py-10 px-6">
        <div className="max-w-4xl mx-auto text-center">
          <h3 className="text-3xl font-bold mb-2">Learn More Efficiently 📈</h3>
          <p className="text-gray-700 mb-4 text-lg leading-relaxed">
            Thanks to a method based on long-term memory and active learning, EasyLearning helps you make lasting progress.
          </p>
          <Link
            href={route('register')}
            className="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 text-lg font-medium transition"
          >
            Join us now
          </Link>
        </div>
      </section>

      <footer className="bg-blue-900 text-white py-6 text-center">
        <p className="text-sm">&copy; {new Date().getFullYear()} EasyLearning. All rights reserved.</p>
      </footer>
    </div>
  );
}
