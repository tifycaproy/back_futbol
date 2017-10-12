<table>
    <tr>
        <th>Título</th>
    </tr>
    @foreach($noticias as $noticia)
        <tr>
            <td>{{ $noticia->tituloNoticia }}</td>
        </tr>
    @endforeach
</table>
<p>...</p>
<div class="row">
    <div class="col-lg-12">
        {{$noticias->render()}}
    </div>
</div>
