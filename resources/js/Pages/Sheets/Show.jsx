/**
 * Fiche de revision a afficher
 * @param {{title: string, description:string, content:string}} sheet 
 * 
 */

import ShowContentQuill from "@/Components/ShowContentQuill";


export default function Show({ sheet }) {
    return <ShowContentQuill>{sheet.content} </ShowContentQuill>
}