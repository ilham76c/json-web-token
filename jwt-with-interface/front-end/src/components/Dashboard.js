import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { jwtDecode } from 'jwt-decode';
import { useNavigate } from 'react-router-dom';
import Navbar from './Navbar';


const Dashboard = () => {
  const [name, setName] = useState('');
  const [token, setToken] = useState('');
  const [expired, setExpired] = useState('');
  const [users, setUsers] = useState([]);
  const navigate = useNavigate();
  
  useEffect(() => {
    refreshToken();
    getUsers();
  }, []);

  const refreshToken = async () => {
    try {
      const response = await axios.get('http://localhost:5000/token');
      setToken(response.data.accessToken);
      const decoded = jwtDecode(response.data.accessToken);
      setName(decoded.name);
      setExpired(decoded.exp);
    } catch (error) {
      if (error.response) {
        navigate('/');
      }
    }
  }

  // create axios interceptors
  const axiosJWT = axios.create();

  // berfungsi untuk melakukan pengecekan sebelum request
  axiosJWT.interceptors.request.use(async (config) => {
    const currentDate = new Date();
    // dikalikan 1000 karena milisecond
    if ((expired * 1000) < currentDate.getTime()) {
      const response = await axios.get('http://localhost:5000/token');
      config.headers.Authorization = `Bearer ${response.data.accessToken}`;
      setToken(response.data.accessToken);
      const decoded = jwtDecode(response.data.accessToken);
      setName(decoded.name);
      setExpired(decoded.exp);
    }

    return config;
  }, (error) => {
    return Promise.reject(error);
  });

  const getUsers = async () => {
    const response = await axiosJWT.get('http://localhost:5000/users', {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    });

    setUsers(response.data);
  }
  return (
    <>
      <Navbar />
      <div className="container mt-5">
        <h1>Welcome Back: {name}</h1>
        <button className='button is-info mt-5' onClick={getUsers}>Get Users</button>
        <div class="table-container">
          <table className='table is-bordered is-striped is-narrow is-hoverable is-fullwidth mt-4'>
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              { users.map((user, index) => (
                <tr key={user.id}>
                  <td>{index + 1}</td>
                  <td>{user.name}</td>
                  <td>{user.email}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </>
  )
}

export default Dashboard
