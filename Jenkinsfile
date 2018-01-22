#!/usr/bin/env groovy
pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building'
                echo 'Git checkout...'
		checkout changelog: false, poll: false, scm: [$class: 'GitSCM', branches: [[name: '*/master']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[credentialsId: 'github', url: 'https://github.com/asubit/lms']]]
		echo 'Git checkout COMPLETE'
	    }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('Deploy') {
            steps {
                echo '==> Deploying....'
		echo '==> [1.] COMPOSER INSTALL'
		sh 'composer install'
		echo '==> [2.] APPLY USER RIGHT ACCESS TO CACHE AND LOGS'
		sh 'chmod -R 777 app/cache app/logs'
		echo '==> [3.] SYMFONY CACHE GENERATION'
		sh 'php app/console cache:clear --env=prod'
		echo '==> End deploy'
            }
        }
    }
}
