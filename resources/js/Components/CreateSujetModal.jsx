import React from "react";
import { useForm } from "@inertiajs/react";
import "./CreateSujet.css";

const CreateSujetModal = ({ isOpen, onClose }) => {
  const { data, setData, post, processing, errors, reset } = useForm({
    title: "",
    description: "",
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log(data);
    console.log(errors);
    

    post(route("quizzes.store"), {
      onSuccess: () => {
        reset();
        onClose();
      },
    });
  };

  if (!isOpen) return null;

  return (
    <div className="modal-overlay">
      <div className="modal-content">
        <h5>Créer un sujet</h5>

        <form onSubmit={handleSubmit}>
          <div className="mb-3">
            <label className="form-label">Nom du sujet</label>
            <input
              type="text"
              className="form-control"
              placeholder="Nommez votre sujet"
              value={data.title}
              onChange={(e) => setData("title", e.target.value)}
              required
            />
            {errors.title && <div className="text-danger">{errors.title}</div>}
          </div>

          <div className="mb-3">
            <label className="form-label">Description</label>
            <textarea
              className="form-control"
              style={{ minHeight: "150px" }} // ⬅️ plus grand textarea
              placeholder="Écrivez votre description (max. 250 caractères)"
              maxLength={250}
              value={data.description}
              onChange={(e) => setData("description", e.target.value)}
            />
            {errors.description && <div className="text-danger">{errors.description}</div>}
          </div>

          <div className="d-flex justify-content-end">
            <button
              type="button"
              className="btn btn-secondary me-2"
              onClick={() => {
                reset();
                onClose();
              }}
            >
              Annuler
            </button>
            <button type="submit" className="btn btn-primary" disabled={processing}>
              {processing ? "Création..." : "Créer"}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default CreateSujetModal;
