# EvaluationSystem
__University project for Software System Development (WUT).__

Technologies:

- CodeIgniter 2
- PHPUnit (CIUnit)
- MySQL
- Bootstrap
- jQuery
- Grunt (task automation)

# Grunt instructions
- Open terminal, go to root folder and run: `npm install -g grunt-cli`
- Now run: `npm install`

# Composer instructions
- Go to root folder and run this command in terminal to install dependencies: `composer install`

# Running tests
- Go to test folder under `root/tests`
- Run commands:
```bash
phpunit models # Run model tests
phpunit models/Filename.php # Run only Filename.php test
phpunit controllers # Run controller tests
phpunit system # Run system tests

# If PHPUnit is not globally installed, run this command from the root directory after installing composer dependencies:
./vendor/bin/phpunit models
```

# Author
Alejandro Perez Martin
