import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { lazy, Suspense } from 'react';
import LogoLoading from '@/Components/LogoLoading';
const LazyLoading = lazy(() => import('@/Components/LazyLoading'))

export default function Welcome() {
  const features = [
    {
      icon: '📝',
      title: 'Créer des fiches',
      text: 'Organise ton apprentissage avec un éditeur de contenu riche (texte, images, couleurs).',
    },
    {
      icon: '🧠',
      title: 'Quiz interactifs',
      text: 'Teste tes connaissances avec des questions à choix unique ou multiples.',
    },
    {
      icon: '📊',
      title: 'Suivi de progression',
      text: 'Analyse tes résultats avec des statistiques et un tableau de bord personnalisé.',
    },
    {
      icon: '💡',
      title: 'Révision intelligente',
      text: 'Utilise la répétition espacée pour retenir plus longtemps.',
    },
    {
      icon: '📚',
      title: 'Flashcards & fiches',
      text: 'Revois rapidement avec un système de cartes mémoire interactives.',
    },
    {
      icon: '🤝',
      title: 'Partage & collaboration',
      text: 'Collabore avec d’autres étudiants et partage tes meilleures fiches.',
    },
  ];

  return (
    <>
    <Head title="Welcome" />
    <Suspense fallback={<LogoLoading/>}>
      <LazyLoading>
        <div className="w-full min-h-screen bg-blue-50 text-gray-800">
          {/* Header */}
          <header className="sticky top-0 z-50 w-full bg-blue-700 py-4 px-8 flex justify-between items-center shadow">
            <h1 className="text-2xl font-bold text-white">EasyLearning</h1>
            <div className="space-x-4">
              <Link href={route('login')} className="text-white font-semibold hover:underline">Connexion</Link>
              <Link href={route('register')} className="bg-white text-blue-700 px-4 py-2 rounded hover:bg-blue-100">S’inscrire</Link>
            </div>
          </header>

          {/* Hero */}
          <section className="min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-200 to-white px-6 text-center">
            <div className="max-w-4xl">
              <h2 className="text-5xl font-extrabold text-blue-800 mb-6 leading-tight">Bienvenue sur EasyLearning 📘</h2>
              <p className="text-xl text-blue-900 mb-8">Une plateforme moderne de révision intelligente pour créer, évaluer et retenir efficacement tes connaissances.</p>
              <div className="flex flex-col sm:flex-row justify-center gap-4">
                <Link href={route('login')} className="bg-blue-700 text-white px-6 py-3 rounded hover:bg-blue-800 font-semibold">Connexion</Link>
                <Link href={route('register')} className="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 font-semibold">Commencer gratuitement</Link>
              </div>
            </div>
          </section>

          {/* Features */}
          <section className="bg-white py-20 px-6">
            <div className="max-w-6xl mx-auto text-center">
              <h3 className="text-3xl font-bold mb-12 text-blue-800">Ce que vous pouvez faire</h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                {features.map((f, i) => (
                  <div key={i} className="bg-blue-100 p-6 rounded-lg shadow hover:shadow-md transition text-center border border-blue-200">
                    <div className="text-4xl mb-4">{f.icon}</div>
                    <h4 className="text-xl font-semibold text-blue-700 mb-2">{f.title}</h4>
                    <p className="text-blue-900 text-sm">{f.text}</p>
                  </div>
                ))}
              </div>
            </div>
          </section>

          {/* CTA section */}
          <section className="bg-blue-100 py-20 px-6">
            <div className="max-w-4xl mx-auto text-center">
              <h3 className="text-3xl font-bold mb-4 text-blue-800">Apprends plus efficacement 📈</h3>
              <p className="text-blue-900 mb-6 text-lg">Grâce à une méthode basée sur la mémoire à long terme et la pédagogie active, EasyLearning t’aide à progresser durablement.</p>
              <Link href={route('register')} className="bg-blue-700 text-white px-8 py-3 rounded-lg hover:bg-blue-800 text-lg font-medium">Rejoins-nous maintenant</Link>
            </div>
          </section>

          {/* Footer */}
          <footer className="bg-blue-900 text-white py-6 text-center">
            <p className="text-sm">&copy; {new Date().getFullYear()} EasyLearning. Tous droits réservés.</p>
          </footer>
        </div>
      </LazyLoading>
    </Suspense>
    </>
  );
}

