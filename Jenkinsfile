pipeline {
    agent { docker { image 'php' } }
    stages {
        stage('build') {
            steps {
                sh "composer install"
            }
        }
        stage('test') {
            sh "./vendor/bin/phpunit"
        }
    }
}
