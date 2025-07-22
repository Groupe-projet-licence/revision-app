/**
 * Fiche de révision à afficher
 * @param {{title: string, description:string, content:string}} sheet 
 */

import SheetModal from "@/Components/SheetModal";
import ShowContentQuill from "@/Components/ShowContentQuill";
import AuthLayouts from "@/Layouts/AuthLayouts";
import { Head, router } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function Show({ sheet }) {
  const [showModal, setShowModal] = useState(false);
  const [nextVisit, setNextVisit] = useState(null);
  const [navigationBlocked, setNavigationBlocked] = useState(true); // ← ajout

  useEffect(() => {
    const cancelNavigation = router.on("before", (event) => {
      if (!navigationBlocked) return; // ← ne bloque pas si autorisé
      event.preventDefault(); // ← bloque
      setNextVisit(event.detail.visit);   // ← stocke
      setShowModal(true);    // ← modale
      setNavigationBlocked(false);
    });

    return () => cancelNavigation(); // nettoyage
  }, [navigationBlocked]); // ← attention ici

  const handleStay = () => {
    setShowModal(false);
    setNextVisit(null);
  };

  const handleLeave = () => {
    setShowModal(false);
    console.log(nextVisit);
    
    if (nextVisit) router.visit(nextVisit.url, nextVisit);; // ← reprend navigation
  };

  return (
    <AuthLayouts>
      <Head>
        <title>Sheets</title>
      </Head>

      <div>
        <SheetModal
          isOpen={showModal}
          cancel={handleStay}
          navigate={handleLeave}
          sheet={sheet}
          disableNavigationBlock={() => setNavigationBlocked(false)} // ← passage de callback
        />
      </div>

      <div>
        <ShowContentQuill>{sheet.content}</ShowContentQuill>
      </div>
    </AuthLayouts>
  );
}
