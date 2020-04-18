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
					'IN FRONT OF THE COLISEUM- Monti, Roma , Lazio',
					'Deluxe Twin Ensuite- Castro Pretorio, Roma , Lazio',
					'Rome Apartment Campo de Fiori- Ponte, Roma , Lazio',
					'Attico Luminoso Deluxe IN FRONT Quirinale',
					'Intero appartamento affittato da Mauro',
					'Tuscan Apt in the heart of Florence',
					'The Smallest Apartment With The Biggest View',
					'BLUE STUDIO34 APARTMENTS',
					'Attico vista mare al centro di Napoli',
					'Bilocale a due passi dal Centro di Torino',
					'Nel Cuore del Barocco Leccese'
				],
			'description' => [
				'Marco e Laura B & BConfortevoli e accoglienti, tutte con servizi privati e situate al piano terra e al secondo piano.La struttura è composta da diverse stanze, tra cui camere doppie e singole (con letto aggiunto).Il B & B ha due ingressi, uno da Via Aurelia (vicino alle mura vaticane), l\'altro da Via Innocenzo XIII.Tutte le camere sono dotate di asciugacapelli, aria condizionata e riscaldamento e tv. Tutte le camere sono dotate di bagno privato con doccia, parete TV al plasma, asciugacapelli e aria condizionata e riscaldamento. Una di queste camere ha un balcone.',
				'Delizioso appartamento nel cuore di Roma, a circa 500mt dal Colosseo e altri principali siti turistici come Via dei Fori Imperiali e Domus Aurea. L\'appartamento si trova al secondo piano in un palazzo silenzioso e tranquillo con ascensore.Facilmente raggiungibile con tutti i mezzi pubblici; autobus, tram e metropolitana (fermata linea B "Colosseo").Presenti diversi ristoranti, pizzerie, bar, supermercati, banche e ufficio postale.Possibilità di offrire culla per bambini gratis.',
				'Meraviglioso appartamento, luminoso, ristrutturato da poco, confortevole e con un fascino unico, a due passi dal Colosseo e dai Fori Imperiali, ubicato in un ottimo punto di partenza per scoprire i tesori nascosti di Roma.Vicino al quartiere Rione Monti, un quartiere da esplorare ricco di locali, ristoranti, market, negozi e vicoli da scoprire.Vicino alle fermate della metro B Colosseo e Cavour e alla stazione Termini che dista solo 15 minuti a piedi.',
				'Uno dei più grandi del Residence, l’uso del ciliegio per i pavimenti siritrova negli arredi e nella scala in legno e acciaio. Posizionato al terzo piano, si sviluppa su due livelli: l’ampio e luminoso salone che si affaccia sul giardino di bamboo, è dotato di due comodi divani e televisione. Un’area ufficio con scrivania e connessione internet gratuita vi permetterà di lavorare da casa in tutta tranquillità. Vicinissimo a Stazione TerminiGrazie alle sue dimensioni, ben si presta ad ospitare famiglie o gruppi di persone: infatti i divani su richiesta possono divenire due letti da una piazza e mezza, creando così un’ulteriore zona notte. Lascala collega il salone con la sala da pranzo, dotata di tavolo in cristallo che può accomodare fino a cinque persone, una seconda televisione e l’ampia cucina abitabile, completamente attrezzata e dotata di isola per la prima colazione.',
				'Il mio appartamento è il punto di partenza ideale per vivere appieno la magica atmosfera del centro storico di Roma. Una zona sicura, a pochi minuti dal Vaticano e dalla caratteristica piazza Campo de Fiori ... una perla del folklore romano.Al momento del check-in vi sarà richiesto di pagare la tassa di soggiorno di Roma 3,50 euro per persona a notte + spese di pulizia di 50 euro. Avrò anche bisogno dei tuoi documenti per registrarti alla polizia locale, secondo la legge antiterrorismo.',
				'La loggia del Quirinale fa parte di un complesso residenziale di villini a schiera, un tempo laboratori di artigiani ed oggi riqualificati in piccoli loft di circa 60 m2. Il complesso residenziale, che vanta una posizione speciale nel cuore di San Lorenzo, si trova in un angolo del quartiere silenzioso e verdeggiante. Ogni loft è preceduto da una piccola terrazza privata dove è possibile rinfrescarsi con un aperitivo nelle calde serate romane. Il loft si sviluppa su tre livelli sovrapposti: al piano terra un ampio soggiorno con divano letto a due piazze, sala da pranzo, cucinino e bagno. Dal piano terra, una rampa di scale collega il soggiorno ad una luminosa ed ampia camera da letto con un piccolo balcone. Un\'altra rampa di scale scende dal soggiorno verso il piano interrato dove si trova un piccolo disimpegno allestito a guardaroba e lavanderia.',
				'NELLA MIGLIOR POSIZIONE DI MILANO direttamente nel cuore del centro in Corso Vittorio Emanuele, a pochi passi da DUOMO Cattedrale (2 minuti a piedi) e tutti i maggiori punti di interesse.
				Lussuoso e luminoso appartamento arredato in stile moderno con: camera da letto, salotto, cucina , bagno ed una splendida veranda. Stabile con ascensore. Pulito e confortevole.',
				'NELLA MIGLIOR POSIZIONE DI MILANO: angolo di Via Montenapoleone la via più chic del quadrilatero della moda, a pochi passi da DUOMO (5 minuti) Cattedrale e nelle vicinanza della SCALA Splendido piccolo appartamento: camera da letto, bagno, cucina e salotto con luminosa veranda. Pulito e confortevole ',
				'La nostra casa è in perfetto stile toscano con i suoi mattoni a vista e il portone a vetri che si affaccia sul giardino. Situato nel cuore di Firenze, ma in una zona molto tranquilla, a pochi passi dal Duomo e dalla stazioneLa nostra casa è in perfetto stile Toscano! Si trova in una zona lussuosa dove molte famiglie ricche fiorentine vivevano e vivono tutto oggi. Piazza Indipendenza con il suo bel giardino è un luogo dove giovani e meno giovani si fermano per fare 2 chiacchiere, riposarsi o prendere un caffè. ',
				'Grazioso piccolo appartamento nella piazza del duomo con una terrazza panoramica che domina tutta la città. La posizione non potrebbe essere migliore. Nell\'appartamento troverai tutto il necessario per rendere il tuo soggiorno il più piacevole possibile, le spese di pulizia e la tassa di soggiorno sono incluse nel prezzo',
				'Questo nuovissimo appartamento è nel pieno centro di Napoli, a pochi minuti a piedi da tutte le attrazioni turistiche e dai tutti i mezzi pubblici: formato da camera da letto con letto matrimoniale, bagno con doccia e soggiorno con divano letto per 2.L\'appartamento è al quinto piano, non esiste ascensore.una perfetta base per visitare la città, esplorare le isole e i dintorni grazie alla vicinanza con porto stazione ferroviaria.',
				'Un luminoso attico vista mare e Vesuvio al centro di Napoli e molto vicino dal lungomare. Un terrazzo 600mq arredato e vista mare Wifi gratis, digitale terrestre sky, aria condizionata, microonde, cucina, macchina del caffè (cialde gratis), asciugamani e lenzuola, shampoo bagnoschiuma ping pong, area relax Il terrazzo privato ampio ed usato come solarium, ha vista sul mare e Vesuvio, circondato dal silenzio e diventa un posto ideale per cenare la sera in compagnia o godersi un piacevole colazione avvolto dal sole della citta',
				'Bilocale in stabile d\'epoca stile Liberty in quartiere San Donato, a due passi dal Centro di Torino, servito da tutti i mezzi pubblici. A 5 minuti a piedi dalla fermata Bernini della Metropolitana e a 10 minuti da piazza Statuto.Sito al 4° piano senza ascensore dispone di: letto matrimoniale su soppalco calpestabile, ampia scrivania, zona giorno con divano letto per un adulto o due bambini, cucina completa, televisore con lettore Dvd e bagno attrezzato con tutti i servizi. Colazione inclusa.',
				'Abitazione si trova di fronte la bellissima Villa Reale (con vista dal balcone), tra Porta Rudie e porta Napoli 2 tra le principali vie d\'accesso al centro storico e a soli 5 min dal Duomo di Lecce, dalla chiesa di Santa Croce e dai più famosi monumenti storici della città . Casa indipendente e di recente ristrutturazione. Nonostante si trovi alle porte del centro storico, è assicurata la privacy e la tranquillità.Facilmente raggiungibile per chi arriva in macchina da Brindisi e a 5 min a piedi dalla fermata del bus-navetta che collega la città con l\'aereoporto.'
		],
			'address' => [
					'Via Orazio, 77- Roma',
					'Piazza del Colosseo-Roma',
					'Rione Monti-Roma',
					'Viale Castro Pretorio, 23-Roma',
					'Viale Giulio Cesare, 47-Roma',
					'Via del Quirinale-Roma',
					'Via Senato, 10- Milano',
					'Via Monte Napoleone-Milano',
					'Piazza della Liberta, 20-Firenze',
					'Via dell\' Oriuolo, 25, Firenze,',
					'Via Marina, 120, Napoli',
					'Via Mergellina, 103, Napoli',
					'Corso Inghilterra, 70, Torino',
					'Via Principi di Savoia, 3, Lecce'
				],
			'cover_img' => [
					'images/seed/001.jpeg',
					'images/seed/002.jpeg',
					'images/seed/003.jpeg',
					'images/seed/004.jpeg',
					'images/seed/005.jpeg',
					'images/seed/006.jpeg',
					'images/seed/007.jpeg',
					'images/seed/008.jpeg',
					'images/seed/009.jpeg',
					'images/seed/010.jpeg',
					'images/seed/011.jpeg',
					'images/seed/012.jpeg',
					'images/seed/013.jpeg'
			],
			'latitude' => [
				'41.8695803',
				'41.8909472',
				'41.8922736',
				'41.9057008',
				'41.9107923',
				'41.9007068',
				'45.4703534',
				'45.4695698',
				'43.7841659',
				'43.7719263',
				'40.8489832',
				'40.823634',
				'45.0731998',
				'40.356313'
			],
			'longitude' => [
				'12.6253393',
				'12.4908501',
				'12.4852967',
				'12.503489',
				'12.4632328',
				'12.4867446',
				'9.1966262',
				'9.1916397',
				'11.2602157',
				'11.2588251',
				'14.2667012',
				'14.2169613',
				'7.6655062',
				'18.1668176'
			]
		];
		for ($i=0; $i < 13; $i++) {
			$apartment = new Apartment;
			$apartment->user_id = User::inRandomOrder()->first()->id;
			$apartment->title = $apartmentTemplate['title'][$i];
			$apartment->description = $apartmentTemplate['description'][$i];
			$apartment->n_rooms = rand(3, 12);
			$apartment->n_baths = rand(1, 3);
			$apartment->sq_meters = rand(50, 200);
			$apartment->address = $apartmentTemplate['address'][$i];
			$apartment->latitude = $apartmentTemplate['latitude'][$i];
			$apartment->longitude = $apartmentTemplate['longitude'][$i];
			$apartment->price = rand(40, 300);
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
