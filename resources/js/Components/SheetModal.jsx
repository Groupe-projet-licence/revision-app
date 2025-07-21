import React from "react";
import { useForm } from "@inertiajs/react";
import "./CreateSujet.css";

const SheetModal = ({ isOpen, onClose, sheet }) => {
  const { data, setData, post, processing, errors, reset } = useForm({
    rate: 50,
  });

  const handleSubmit = (e) => {
    e.preventDefault();    
    

    post(route("sheets.nextRevision",sheet), {
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
        <h1 className="fw-bold d-flex justify-content-between mb-4" >Indiquez votre niveau de maitrise <i className="bi bi-pencil text-secondary"></i></h1>
        
        <form onSubmit={handleSubmit}>
          <div className="mb-3 d-flex justify-content-between flex-column align-items-center">
            <input
              type="range"
              className="form-control"
              value={data.rate}
              onChange={(e) => setData("rate", e.target.value)}
              required
            />
            <label className="form-label">{data.rate}%</label>
            {errors.rate && <div className="text-danger">{errors.rate}</div>}
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
              Cancel
            </button>
            <button type="submit" className="btn btn-primary" disabled={processing}>
              {processing ? "Storing..." : "Store"}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default SheetModal;
