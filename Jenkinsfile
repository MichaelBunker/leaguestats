pipeline {
    agent { docker { image 'php' } }
    stages {
        stage('build') {
            steps {
                checkout scm
                sh "composer install"
            }
        }
        stage('test') {
            sh "./vendor/bin/phpunit"
        }
    }
}
