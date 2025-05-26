export default function ShowContentQuill({children,className='', ...props}){
    return <div className={`ql-editor ${className}`} contentEditable={false} {...props} dangerouslySetInnerHTML={{ __html: children }}/>
}