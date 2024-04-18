import express from 'express';
import cookieParser from 'cookie-parser';
import cors from 'cors';
// import dotenv from 'dotenv';
// dotenv.config();
import db from './config/Database.js';
// import Users from './models/UserModel.js';
import router from './routes/index.js';
const app = express();

try {
  await db.authenticate();
  console.log('Database connected.');

  /*
  * Fungsi Users.sync(): jika table Users tidak ada atau tidak exist maka sequelize akan meng-generate table tersebut secara otomatis.
  * kolom id, createdAt, dan updatedAt akan auto ditambahkan oleh sequelize.
  */
  // await Users.sync(); 
} catch (error) {
  console.error(error);
}

app.use(cors({ credentials: true, origin: 'http://localhost:3000' }));
app.use(cookieParser());
app.use(express.json());
app.use(router);

app.listen(5000, () => console.log(`Server running at port 5000`));