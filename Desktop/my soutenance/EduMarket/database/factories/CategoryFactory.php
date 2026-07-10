<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    private static array $descriptions = [
        'Manuels Universitaires' => 'Comprehensive textbooks and academic references covering a wide range of university subjects including economics, law, computer science, psychology, marketing, and the natural sciences. Carefully selected to support higher education curriculum and exam preparation.',
        'Arts Créatifs' => 'Art and craft supplies for creative expression, including painting kits, modeling clay, origami paper, mosaic sets, watercolor blocks, canvas boards, and marker collections. Perfect for students, hobbyists, and professional artists alike.',
        'Calculatrices' => 'A complete selection of scientific, graphing, financial, and basic calculators from leading brands such as Casio, Texas Instruments, HP, and NumWorks. Suitable for classroom use, exams, and professional office work.',
        'Kits Pédagogiques' => 'Hands-on educational kits that make learning engaging and interactive. Includes robotics sets, chemistry labs, microscopes, telescopes, anatomy models, and renewable energy experiment kits designed to spark curiosity in STEM fields.',
        'Langues Étrangères' => 'Language learning resources and reference books for English, Spanish, German, and other foreign languages. Features comprehensive dictionaries, grammar guides, vocabulary builders, and immersive audio course materials from trusted publishers.',
        'Papeterie' => 'Essential office and paper supplies including printer paper reams, notebooks, envelopes, ring binders, cardboard folders, divider tabs, sticky notes, and sheet protectors. Quality stationery for everyday professional and academic use.',
        'Matériel de Classe' => 'Classroom equipment and teaching aids designed for educators. Includes whiteboards, bulletin boards, teacher desks, attendance trackers, educational clocks, and presentation tools to create an effective learning environment.',
        'Fournitures Scolaires' => 'Everyday school essentials for students of all ages. Pens, pencils, notebooks, erasers, rulers, compasses, scissors, glue, backpacks, pencil cases, and highlighters — everything needed for a successful school year.',
        'Sciences et Expériences' => 'Science equipment and experiment kits for exploring biology, chemistry, physics, and astronomy. Includes microscopes, telescopes, lab thermometers, dissection tools, weather stations, and DIY science project kits.',
        'Livres' => 'Curated collection of educational books for primary and secondary school students. Covers mathematics, French, history, geography, science, philosophy, and language arts with workbooks, dictionaries, and exam preparation guides.',
        'Informatique et Programmation' => 'Computer hardware, accessories, and programming tools for students and tech enthusiasts. Laptops, mechanical keyboards, mice, webcams, USB drives, networking equipment, and cables — everything for the modern digital workspace.',
        'Outils de Dessin' => 'Professional drawing and sketching supplies for artists and design students. Colored pencils, watercolor crayons, pastels, sketchbooks, geometry sets, acrylic paints, gouache, and canvas boards for all skill levels.',
    ];

    public function definition(): array
    {
        $name = fake()->unique()->randomElement(array_keys(self::$descriptions));

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => self::$descriptions[$name],
        ];
    }
}
