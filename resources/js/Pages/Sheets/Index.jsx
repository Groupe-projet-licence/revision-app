import { useContext, useEffect, useState } from "react";
import Card from "../../Components/Card";

import AuthLayouts from "@/Layouts/AuthLayouts";
import { Head, Link, usePage } from "@inertiajs/react";
import { useSearchBar } from "@/Layouts/AuthLayouts";
import TutorialGuide from "@/Components/TutorialGuide";


export default function Index({ sheets, categories, selectedCategory }) {

  const { auth } = usePage().props;

  //Differentes pop up
  const steps = [{ target: '.btn-create-sheet', content:'Click here to create your first revision sheet!',},
                    { target: '.categorie', content:'Here you can sort your files according to a category, choose one and all the files that have the same category will be displayed.',},
                ];

 

  // 🔍 Filtrage par recherche (titre ou description)
  const searchKeyword = useSearchBar();
  const filteredSheets = searchKeyword
    ? sheets.filter(
      (sheet) =>
        sheet.title?.toLowerCase().includes(searchKeyword.toLowerCase()) ||
        sheet.description?.toLowerCase().includes(searchKeyword.toLowerCase())
    )
    : sheets;

  return (
    <>
      <Head>
        <title>Sheet</title>
      </Head>
      <div>
        {/*Affichage du tutoriel*/}
        <TutorialGuide steps={steps} user={auth.user}/>

        <div className="d-md-flex justify-content-between align-items-center mb-4">

          {/* 🎯 Filtre par catégorie */}
          <div className="col col-md-4  p-0 categorie">
            <select
              style={{ borderRadius: '5px', minWidth: '250px' }}
              className="form-select"
              value={selectedCategory || ""}
              onChange={(e) => {
                const value = e.target.value;
                const url = value ? `?category_id=${value}` : "";
                window.location.href = route("sheets.index") + url;
              }}
            >
              <option value="">All categories</option>
              {categories.map((cat) => (
                <option key={cat.id} value={cat.id}>
                  {cat.subject} - Level {cat.level}
                </option>
              ))}
            </select>
          </div>

          {/* ➕ Bouton de création */}
          <div className="text-end mt-1 btn-create-sheet">
            <Link className="btn btn-primary btn-sm" href="/sheets/create">
              <span className="fs-5">+</span> New sheet
            </Link>
          </div>
        </div>

        {/* 📋 Liste des fiches */}
        <div className="container-grid-css-card">
          {filteredSheets.length > 0 ? (
            filteredSheets.map((sheet) => (
              <Card data={sheet} key={sheet.id} />
            ))
          ) : (
            <div className="text-center text-muted my-5">
              🗂️ No revision sheet matches this category or your search
            </div>
          )}
        </div>
      </div>
    </>
  );
}

Index.layout = page => <AuthLayouts children={page} />