import React, { useState } from 'react';
import './CreateSujet.css'; // On suppose que tu crées ce fichier CSS à côté

const CreateSujet = () => {
  const [nom, setNom] = useState('');
  const [description, setDescription] = useState('');
  const [matiere, setMatiere] = useState('');

  const matieres = [
    'Mathématiques',
    'Physique',
    'Chimie',
    'Informatique',
    'Histoire',
    'Géographie'
  ];

  const handleSubmit = (e) => {
    e.preventDefault();
    const sujet = { nom, description, matiere };
    console.log('Sujet créé :', sujet);
    // Envoie des données au backend ici si nécessaire
  };

  return (
    <div className="form-container">
      <form onSubmit={handleSubmit} className="sujet-form">
        <h2>Créer un sujet</h2>

        <label>Nom :</label>
        <input
          type="text"
          placeholder="Nommez votre sujet"
          value={nom}
          onChange={(e) => setNom(e.target.value)}
          required
        />

        <label>Description (max. 250 caractères)</label>
        <textarea
          placeholder="Écrivez une brève description"
          value={description}
          onChange={(e) => setDescription(e.target.value)}
          maxLength={250}
        />

        <label>Matière concernée *</label>
        <select
          value={matiere}
          onChange={(e) => setMatiere(e.target.value)}
          required
        >
          <option value="">Choisissez une matière</option>
          {matieres.map((m, index) => (
            <option key={index} value={m}>{m}</option>
          ))}
        </select>

        <div className="form-buttons">
          <button type="button" className="cancel">Annuler</button>
          <button type="submit" className="submit">Créer</button>
        </div>
      </form>
    </div>
  );
};

export default CreateSujet;

