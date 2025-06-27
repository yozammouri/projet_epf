import Link from 'next/link'
import React from 'react'

export default function formationItem({ formation }: { formation: Formation }) {
  return (
    <>
        <li className="p-1 h-[67.95px]">
  <Link href="">
    <div className="grid grid-cols-4 items-center h-full hover:bg-green-600 hover:text-white transition duration-100 rounded-md">
      <span className="w-full font-medium text-sm ml-[5px] ">{formation.name}</span>
      <span className="w-full text-xs ml-[15px]">{formation.categorie}</span>
      <span className="w-full ml-[55px] text-xs text-black font-bold">{formation.volume_horaire} Hrs</span>
      <span className="w-full text-xs">{formation.lieux}</span>
    </div>
  </Link>
</li>

    </>
  )
}
