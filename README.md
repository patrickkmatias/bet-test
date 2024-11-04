# Bet
#### Admissional test for "RealsBet" company

## 🚀 Run the project

- Needed dependencies: [Docker Engine](https://docs.docker.com/engine/), [Node.js](https://nodejs.org/en), [Laravel](https://laravel.com/docs/11.x) (along with PHP and Composer). Linux is recommended.

1. After cloning the project, you should start PostgreSQL database to fill it with test data:
```sh
docker compose up -d
```
2. Then, you can run the following command to install all dependencies and prepare all the environment of a newly cloned repository:
```sh
npm run init
```
3. Now you can start the development server, starting the Vite's resources server and also Laravel's server:

```sh
npm run dev

# In a new bash:
php artisan serve
``` 

If the seeding was successful, you will be able to access the system with these default credentials:
```
Email: test@example.com
Password: password
```
- The project is covered by tests; they can be executed using `php artisan test`

<details>
<summary><h2> 🎆 Other </h2></summary>
<li>See <a href="https://dourados-store.vercel.app/">this project</a> <a href="https://github.com/pmattheew/dourados-store">(src)</a> that I could complete in 4 days in a technology that I hadn't used before.</li>
<li><a href=https://patrickkmatias.github.io/site-bdourados >A project that I'm proud of 🙂</a> <em>(with PHP in backend!)</em></li>
</details>
