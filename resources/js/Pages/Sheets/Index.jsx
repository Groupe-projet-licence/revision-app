import { useEffect, useState } from "react";
import Card from "../../Components/Card";
import AuthLayout from "@/Layouts/AuthLayouts1";
import { Link } from "@inertiajs/react";

/**
 * Wrapper pour injecter la recherche
 */
export default function IndexWrapper(props) {
  return (
    <AuthLayout>
      {(searchKeyword) => <Index {...props} searchKeyword={searchKeyword} />}
    </AuthLayout>
  );
}

/**
 * Composant principal : liste des fiches
 */
function Index({ sheets, flash, categories, selectedCategory, searchKeyword }) {
  const [messageSuccess, setMessageSuccess] = useState(flash.success);

  useEffect(() => {
    if (flash?.success) {
      const timer = setTimeout(() => {
        setMessageSuccess(null);
        window.location.reload();
      }, 3000);
      return () => clearTimeout(timer);
    }
  }, [flash]);

  // 🔍 Filtrage par recherche (titre ou description)
  const filteredSheets = searchKeyword
    ? sheets.filter(
        (sheet) =>
          sheet.title?.toLowerCase().includes(searchKeyword.toLowerCase()) ||
          sheet.description?.toLowerCase().includes(searchKeyword.toLowerCase())
      )
    : sheets;

  return (
    <div>
      {messageSuccess && (
        <div className="alert alert-info flash-messge-success">
          {messageSuccess}
        </div>
      )}

      {/* 🎯 Filtre par catégorie */}
      <div className="row mb-3">
        <div className="col-md-4">
          <select
            className="form-select"
            value={selectedCategory || ""}
            onChange={(e) => {
              const value = e.target.value;
              const url = value ? `?category_id=${value}` : "";
              window.location.href = route("sheets.index") + url;
            }}
          >
            <option value="">Toutes les catégories</option>
            {categories.map((cat) => (
              <option key={cat.id} value={cat.id}>
                {cat.subject} - Niveau {cat.level}
              </option>
            ))}
          </select>
        </div>
      </div>

      {/* ➕ Bouton de création */}
      <div className="text-end">
        <Link className="btn btn-primary mb-4" href="/sheets/create">
          <span className="fs-5">+</span> New sheet
        </Link>
      </div>

      {/* 📋 Liste des fiches */}
      <div className="row">
        {filteredSheets.length > 0 ? (
          filteredSheets.map((sheet) => (
            <Card data={sheet} key={sheet.id} />
          ))
        ) : (
          <div className="text-center text-muted my-5">
            🗂️ Aucune fiche ne correspond à cette catégorie ou à votre recherche.
          </div>
        )}
      </div>
    </div>
  );
}
