pipeline {
    agent { docker { image 'php' } }
    stages {
        stage('build') {
            steps {
                bat "composer install"
                bat "./bin/phpunit"
            }
        }
    }
}
