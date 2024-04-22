import React from 'react'
import Navbar from './Navbar'

const Dashboard = () => {
  return (
    <div className="has-background-white">
      <Navbar />
      <div className="container mt-5 hero is-fullheight-with-navbar">
        <h1>Welcome Back:</h1>
      </div>
    </div>
  )
}

export default Dashboard
