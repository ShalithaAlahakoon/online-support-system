    Open Project in WSL (Ubuntu):
        Open your project in WSL using the Ubuntu server.

    Create Docker Container:
        Inside the WSL terminal, run the command sail up to create a Docker container for your project.

    Install Composer Dependencies:
        Run sail composer install to install PHP dependencies.

    Install NPM Dependencies:
        Run sail npm install to install Node.js dependencies.

    Build Assets:
        Execute sail npm run build to build your project's assets.

    Run Database Migrations and Seed:
        Run sail artisan migrate --seed to apply migrations and seed the database.

    Clear Configuration Cache:
        Run sail artisan config:clear to clear configuration cache.

    Clear Application Cache:
        Run sail artisan cache:clear to clear application cache.

    Rebuild Assets (Optional):
        Run sail npm run build again.

    Login to System:

    Use the following credentials to log in:
        Username: support@onlinesupportsystem.com
        Password: password

    Test the Project:

    Proceed to test your project.

    Email Testing with Mailtrap:

    Update the .env file to configure Mailtrap for email testing.

Remember to replace placeholders like your_project_directory with actual paths, and adjust any specific details based on your project's structure.

These instructions assume that you have a Laravel project with Sail for local development. If it's a different kind of project, some steps might be different. Always refer to the project's documentation for specific setup instructions.