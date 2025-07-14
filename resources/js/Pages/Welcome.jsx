import React from 'react';
import { Link, usePage } from '@inertiajs/react';

export default function Welcome() {
  const { auth } = usePage().props;

  const features = [
    {
      icon: '📝',
      title: 'Create Notes',
      text: 'Organize your learning with a rich content editor (text, images, colors).',
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
    <div className="w-full min-h-screen bg-blue-900 text-black font-serif">
      <header className="sticky top-0 z-50 w-full bg-blue-900 text-white shadow-md py-4 px-8 flex justify-between items-center">
        <h1 className="text-2xl font-extrabold tracking-wide">Easy Learning</h1>
        <div className="space-x-4">
          <Link href={route('login')} className="hover:underline font-medium">Login</Link>
          <Link href={route('register')} className="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 font-semibold transition">Sign Up</Link>
        </div>
      </header>
      <section className="bg-white px-6 py-16">
        <h2 className="text-5xl font-bold text-blue-800 text-center mb-12">Welcome to Easy Learning 📘</h2>
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
              <span className="font-semibold text-blue-700">Easy Learning</span> is the ideal platform to learn and revise efficiently.
              Access clear and concise lessons on a variety of topics, test your knowledge with interactive quizzes, and track your progress in real time.
              Study at your own pace, wherever you are.
            </p>
          </div>
        </div>
      </section>
      <section className="bg-blue py-10 px-6" >
        <div className="max-w-6xl mx-auto text-center">
          <h3 className="text-3xl sm:text-4xl font-bold mb-10 text-white bg">Try it now</h3>
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            {features.map((f, i) => (
              <div key={i} className="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
                <div className="text-5xl mb-4">{f.icon}</div>
                <h4 className="text-xl font-semibold text-blue-700 mb-2">{f.title}</h4>
                <p className="text-gray-700 text-sm mb-6 leading-relaxed">{f.text}</p>
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

      {/* Why Choose */}
      <section className="bg-white py-12 px-6">
        <div className="max-w-5xl mx-auto">
          <h2 className="text-3xl font-bold text-center text-blue-800 mb-10">Why Choose Easy Learning?</h2>

          <div className="space-y-8 text-gray-800 text-base leading-relaxed">
            <div>
              <h3 className="text-xl font-semibold text-blue-700 mb-2">Create Utra-Customized Revision Sheets</h3>
              <p>You are not limited to plain text: you can format your revision Sheets however you like,inserting bullet lists,bold or text,images,...,all to create sheets taillored to your lessons and personal needs. 
</p>
</div>
            <div>
              <h3 className="text-xl font-semibold text-blue-700 mb-2">Complete Sheet Management</h3>
              <p>You can edit your revision sheets at any time to update or correct them. You can also delete them to keep a clean workspace.Additionally,sheets are organized by subject for quick access to information. 
          </p>
            </div>

            <div>
              <h3 className="text-xl font-semibold text-blue-700 mb-2">Smart Revision(Spaced Repetition)</h3>
              <p>Easy Learning automatically selects the sheets you should revice first. This proven metho boots long-term memory retention 
    </p>
            </div>

            <div>
              <h3 className="text-xl font-semibold text-blue-700 mb-2">Fast and Simple Revision Mode</h3>
              <p>Easy Learning offers a full-screen display of your sheets,allowing you to focus solely on the content, with fast navigation between sheets,without reloading or delays. You can revise smoothly breaking your momentum.
               </p>
            </div>

            <div>
              <h3 className="text-xl font-semibold text-blue-700 mb-2">Create Quizzes</h3>
              <p>Create your own quizzes tailored to your needs and courses, with single or multiple-choice question(radio buttons or checkboxes).No more generic quizzes that don't match your objectives.
              </p>
            </div>

            <div>
              <h3 className="text-xl font-semibold text-blue-700 mb-2">Automatic Evaluation</h3>
              <p>Take your quizzes and instantly receive your score and correction. No manual grading:save time and  immediately identify your strengths and weaknesses.
                </p>
            </div>
          </div>
        </div>
      </section>

      <section className="bg-white py-10 px-6">
        <div className="max-w-4xl mx-auto text-center">
          <h3 className="text-3xl font-bold mb-2">Learn More Effectively 📈</h3>
          <p className="text-gray-700 mb-4 text-lg leading-relaxed">
            Thanks to a method based on long-term memory and active learning, Easy Learning helps you make lasting progress.
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
        <p className="text-sm">&copy; {new Date().getFullYear()} Easy Learning. All rights reserved.</p>
      </footer>
    </div>
  );
}
