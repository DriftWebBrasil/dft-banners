# Drift Banners
* Autor: Matheus Darós
* Tags: banner, slider

Adiciona banners e um shortcode para criar um slider.

## Descrição 

É adicionado um post type "banners" ao site, sendo cadastrável no painel administrativo. Ao criar um banner, é cadastrado uma imagem para computador e outro para dispositivos móveis. E por meio do shortcode `[dft-banner]`, é possível adicionar emqualquer local do site

## Instalação 

1. Baixe o plugin em formato zip
1. Ative-o dentro do painel 'Plugins'
1. Adicione o shortcode `[dft-banner]` dentro do template

## Actions/Filters

### Filters

#### `apply_filters('dft_banners_desktop_width_size', $width)` 
Muda a largura do tamanho de imagem para computador dos banners, em pixels. Padrão: 1920

#### `apply_filters('dft_banners_desktop_height_size', $height)` 
Muda a altura do tamanho de imagem para computador dos banners, em pixels. Padrão: a opção selecionada no painel. Se vazio, 700

#### `apply_filters('dft_banners_mobile_width_size', $width)` 
Muda a largura do tamanho de imagem para dispositivo móvel dos banners, em pixels. Padrão: 1024

#### `apply_filters('dft_banners_mobile_height_size', $height)` 
Muda a altura do tamanho de imagem para dispositivo móvel dos banners, em pixels. Padrão: 640

## Changelog 

### 1.0 
* Criado o funcionamento básico
