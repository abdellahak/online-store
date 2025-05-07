<div>
    <div class="container">
        <h1>Soldes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produit</th>
                    <th>Pourcentage</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($soldes as $solde)
                    <tr>
                        <td>{{ $solde->id }}</td>
                        <td>{{ $solde->produit->nom }}</td>
                        <td>{{ $solde->pourcentage }}%</td>
                        <td>{{ $solde->date_debut }}</td>
                        <td>{{ $solde->date_fin }}</td>
                        <td>
                            <!-- Actions to edit or delete the sale -->
                            <a href="{{ route('admin.soldes.edit', $solde->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('admin.soldes.destroy', $solde->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        {{ $soldes->links() }}
    </div>

    <!-- Include the footer -->
    @include('admin.footer')
</div>
