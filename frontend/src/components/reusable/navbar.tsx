import React from 'react'
import Link from 'next/link';
import { Button } from '../ui/button';

export default function navbar() {
  return (
    <nav className="flex items-center justify-between px-8 py-4 bg-white shadow-sm">
      <div className="text-lg font-bold">Logo</div>

      <div className="flex space-x-6">
        <Link href="/">
          <span className="hover:text-blue-600 cursor-pointer font-medium">Home</span>
        </Link>
        <Link href="/">
          <span className="hover:text-blue-600 cursor-pointer font-medium">About Us</span>
        </Link>
        <Link href="/">
          <span className="hover:text-blue-600 cursor-pointer font-medium">Services</span>
        </Link>
        <Link href="/">
          <span className="hover:text-blue-600 cursor-pointer font-medium">Contact Me</span>
        </Link>
      </div>

      <div className="flex items-center space-x-4">
        <Link href="/login" className='cursor-pointer'><Button className="text-white hover:underline">
            Sign In
        </Button></Link>
      </div>
    </nav>
  )
}
