const express = require('express');
const mysql = require('mysql2');
const { createObjectCsvWriter } = require('csv-writer');
const path = require('path');
const app = express();
const port = 3000;

// Configuration de la connexion à la base de données
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root', // Assurez-vous d'utiliser votre nom d'utilisateur MySQL
  password: '', // Assurez-vous d'utiliser votre mot de passe MySQL
  database: 'taskmaster'
});

// Connexion à la base de données
db.connect((err) => {
  if (err) {
    console.error('Erreur de connexion à la base de données:', err);
    return;
  }
  console.log('Connecté à la base de données MySQL');
});

// Route pour exporter les données vers un fichier CSV
app.get('/export-csv', (req, res) => {
  const query = 'SELECT * FROM tasks'; // Remplacez 'tasks' par le nom de votre table

  db.query(query, (err, results) => {
    if (err) {
      console.error('Erreur lors de l\'exécution de la requête:', err);
      res.status(500).send('Erreur lors de l\'exécution de la requête.');
      return;
    }

    // Configuration du fichier CSV
    const csvWriter = createObjectCsvWriter({
      path: 'data.csv',
      header: Object.keys(results[0]).map(key => ({ id: key, title: key.toUpperCase() }))
    });

    // Écriture des données dans le fichier CSV
    csvWriter.writeRecords(results)
      .then(() => {
        // Envoi du fichier CSV en réponse
        res.download(path.join(__dirname, 'data.csv'), 'data.csv', (err) => {
          if (err) {
            console.error('Erreur lors du téléchargement du fichier:', err);
            res.status(500).send('Impossible de télécharger le fichier.');
          }
        });
      })
      .catch(err => {
        console.error('Erreur lors de l\'écriture des enregistrements dans le fichier CSV:', err);
        res.status(500).send('Erreur lors de l\'écriture des enregistrements dans le fichier CSV.');
      });
  });
});

// Démarrage du serveur
app.listen(port, () => {
  console.log(`Serveur en cours d'exécution sur http://localhost:${port}`);
});
