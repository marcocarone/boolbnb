<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use App\Service;
use Faker\Generator as Faker;

class ApartmentsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(Faker $faker)
	{
		$apartmentTemplate = [
			'title' => [
					'Marco e Laura B & B: camera doppia- Aurelio, Roma , Lazio',
					'Laterano238apartment- Celio, Roma, Lazio',
					'N FRONT OF THE COLISEUM- Monti, Roma , Lazio',
					'Deluxe Twin Ensuite- Castro Pretorio, Roma , Lazio',
					'Rome Apartment Campo de Fiori- Ponte, Roma , Lazio',
					'Attico Luminoso Vista Mare IN FRONT Quirinale'
				],
			'description' => [
				'Marco e Laura B & BConfortevoli e accoglienti, tutte con servizi privati e situate al piano terra e al secondo piano.La struttura è composta da diverse stanze, tra cui camere doppie e singole (con letto aggiunto).Il B & B ha due ingressi, uno da Via Aurelia (vicino alle mura vaticane), l\'altro da Via Innocenzo XIII.Tutte le camere sono dotate di asciugacapelli, aria condizionata e riscaldamento e tv. Tutte le camere sono dotate di bagno privato con doccia, parete TV al plasma, asciugacapelli e aria condizionata e riscaldamento. Una di queste camere ha un balcone.',
				'Delizioso appartamento nel cuore di Roma, a circa 500mt dal Colosseo e altri principali siti turistici come Via dei Fori Imperiali e Domus Aurea. L\'appartamento si trova al secondo piano in un palazzo silenzioso e tranquillo con ascensore.Facilmente raggiungibile con tutti i mezzi pubblici; autobus, tram e metropolitana (fermata linea B "Colosseo").Presenti diversi ristoranti, pizzerie, bar, supermercati, banche e ufficio postale.Possibilità di offrire culla per bambini gratis.',
				'Meraviglioso appartamento, luminoso, ristrutturato da poco, confortevole e con un fascino unico, a due passi dal Colosseo e dai Fori Imperiali, ubicato in un ottimo punto di partenza per scoprire i tesori nascosti di Roma.Vicino al quartiere Rione Monti, un quartiere da esplorare ricco di locali, ristoranti, market, negozi e vicoli da scoprire.Vicino alle fermate della metro B Colosseo e Cavour e alla stazione Termini che dista solo 15 minuti a piedi.',
				'Uno dei più grandi del Residence, l’uso del ciliegio per i pavimenti siritrova negli arredi e nella scala in legno e acciaio. Posizionato al terzo piano, si sviluppa su due livelli: l’ampio e luminoso salone che si affaccia sul giardino di bamboo, è dotato di due comodi divani e televisione. Un’area ufficio con scrivania e connessione internet gratuita vi permetterà di lavorare da casa in tutta tranquillità. Vicinissimo a Stazione TerminiGrazie alle sue dimensioni, ben si presta ad ospitare famiglie o gruppi di persone: infatti i divani su richiesta possono divenire due letti da una piazza e mezza, creando così un’ulteriore zona notte. Lascala collega il salone con la sala da pranzo, dotata di tavolo in cristallo che può accomodare fino a cinque persone, una seconda televisione e l’ampia cucina abitabile, completamente attrezzata e dotata di isola per la prima colazione.',
				'Il mio appartamento è il punto di partenza ideale per vivere appieno la magica atmosfera del centro storico di Roma. Una zona sicura, a pochi minuti dal Vaticano e dalla caratteristica piazza Campo de Fiori ... una perla del folklore romano.Al momento del check-in vi sarà richiesto di pagare la tassa di soggiorno di Roma 3,50 euro per persona a notte + spese di pulizia di 50 euro. Avrò anche bisogno dei tuoi documenti per registrarti alla polizia locale, secondo la legge antiterrorismo.',
				'La loggia del Quirinale fa parte di un complesso residenziale di villini a schiera, un tempo laboratori di artigiani ed oggi riqualificati in piccoli loft di circa 60 m2. Il complesso residenziale, che vanta una posizione speciale nel cuore di San Lorenzo, si trova in un angolo del quartiere silenzioso e verdeggiante. Ogni loft è preceduto da una piccola terrazza privata dove è possibile rinfrescarsi con un aperitivo nelle calde serate romane. Il loft si sviluppa su tre livelli sovrapposti: al piano terra un ampio soggiorno con divano letto a due piazze, sala da pranzo, cucinino e bagno. Dal piano terra, una rampa di scale collega il soggiorno ad una luminosa ed ampia camera da letto con un piccolo balcone. Un\'altra rampa di scale scende dal soggiorno verso il piano interrato dove si trova un piccolo disimpegno allestito a guardaroba e lavanderia.'
				],
			'address' => [
					'Via Orazio, 77', 
					'Via Roma, 1', 
					'Largo Calamandrei, 17', 
					'Piazzale Tecchio, 23', 
					'Viale Giulio Cesare, 47B', 
					'Via Del Vecchio, 31A'
				],
			'cover_img' => [
					'images/En2fDXvvJzQJwtBod1zIfvYiwiW2NIZAXPxHAjxk.jpeg', 
					'images/hWUKvjj2syVMr0k2eO7SEnVyB9ExUkN8hOxCxq5m.jpeg', 
					'images/IN5Lg3Q.jpg', 
					'images/w8PLbmeW2VoHxM9lzYy89Vu1P2juUw7tecN0TLhE.jpeg', 
					'images/tWU5bnt.jpg', 
					'images/s8rc7sj.jpg'
				]
		];
		for ($i=0; $i < 6; $i++) { 
			$apartment = new Apartment;
			$apartment->user_id = User::inRandomOrder()->first()->id;
			$apartment->title = $apartmentTemplate['title'][$i];
			$apartment->description = $apartmentTemplate['description'][$i];
			$apartment->n_rooms = rand(1, 10);
			$apartment->n_baths = rand(1, 5);
			$apartment->sq_meters = rand(10, 200);
			$apartment->address = $apartmentTemplate['address'][$i];
			$apartment->latitude = 41.919397;
			$apartment->longitude = 12.404554;
			$apartment->price = rand(30, 300);
			$apartment->cover_img = $apartmentTemplate['cover_img'][$i];
			$apartment->active = 1;
			$apartment->save();

			$services = Service::all();
			
			for ($x=0; $x < rand(0, 11); $x++) { 
				unset($services[rand(1, count($services))]);
			}

			$apartment->services()->attach($services);
		}
	}
}
