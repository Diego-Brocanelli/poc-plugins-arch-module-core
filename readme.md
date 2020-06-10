# Arquitetura de Plugins: Módulo Core

Exemplo de módulo compartilhado para arquitetura de plugins


# GitHub API

GitHub API limit (0 calls/hr) is exhausted, could not fetch https://api.github.com/repos/bueno-networks-time/poc-plugins-arch-module-core/tags?per_page=100. Create a GitHub OAuth token to go over the API rate limit. You can also wait until ? for the rate limit to reset.

Head to https://github.com/settings/tokens/new?scopes=repo&description=Composer+on+ricardo-Inspiron-5566+2020-06-10+1018
to retrieve a token. It will be stored in "/home/ricardo/.config/composer/auth.json" for future use by Composer.
Token (hidden): 
Token stored successfully.
Updating dependencies (including require-dev)

> Personal Accesse Tokens: https://github.com/settings/tokens


https://getcomposer.org/doc/05-repositories.md#loading-a-package-from-a-vcs-repository


{
            "type": "path",
            "url": "../poc-plugins-arch-module-core",
            "options": {
                // Tem que ser falso para poder obter o pacote fora do laravel
                // senão o docker não terá visibilidade para fazer o link
                "symlink": false
            }
        }

