@extends('layouts.masters.home')
@section('content')
<div class="container">
    <div class="mt-50">
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a data-toggle="pill" href="#basic">Basics</a></li>
            <li><a data-toggle="pill" href="#benefits">Benefits</a></li>
            <li><a data-toggle="pill" href="#om">O & M</a></li>
            <li><a data-toggle="pill" href="#technology">Technology</a></li>
            <li><a data-toggle="pill" href="#mnresupport">MNRE Support Policy & Scheme</a></li>
        </ul>

        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="box box-primary">
                    <div class="box-body faq-box">
                        <b>Q. What is biogas?</b>
                        <p class="mb-10"><b>A.</b> Biogas is a combustible gaseous fuel that is collected from the microbial degradation of organic matter in anaerobic conditions (without oxygen). Biogas is principally a mixture of methane (CH4) and carbon dioxide (C02) along with other trace gases. Biogas can be collected from landfills, covered lagoons, or enclosed tanks called anaerobic digesters. The biogas typically has 60% methane and 35% carbon di oxide. There is also some percentage of hydrogen, nitrogen, oxygen, ammonia, moisture etc.<a>(1. BDTC)</a></p>
                         <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/1.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="20%" height="20%">
                        <div class="clearfix"></div>
                        <b>Q. In which conditions biogas can be produced?</b>
                        <p class="mb-20"><b>A.</b> Biogas production is obtained by anaerobic decomposition (absence of oxygen) of biomass in the presence of bacteria. The bacterial decomposition of biomass takes place in three phases, namely hydrolysis phase, acid phase and methane phase.<a>(9. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. What is the potential of implementation of biogas plant in India?</b>
                        <p class="mb-20"><b>A.</b> According to statistical data of availability of cattle dung, there is a potential of construction of 12 million family size biogas plants in India.<a>(11. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <b>Q. What is organic material?</b>
                        <p class="mb-20"><b>A.</b> Simply speaking organic material is something that was living and can decay (principally animals and plants). Wasted or spoiled food, plant clippings, animal manure, meat trimmings and sewage are common types of organic material used with anaerobic digestion. In contrast, inorganic material includes things like rocks, dirt, plastic, metal and glass.<a>(2. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <b>Q. What are the sources of organic matter useful for biogas production?</b>
                        <p class="mb-20"><b>A.</b> Biogas is commonly made from animal slurry, sludge settled from wastewater and at landfills containing organic wastes. However, biogas can also be made from almost any organic waste has the ability to produce biogas: human excreta, slurry, animal slurry, fruit and vegetable waste, slaughterhouse waste, meat packing waste, dairy factory waste, brewery and distillery waste, etc. Fiber rich wastes like wood, leaves, etc. make poor feed stocks for digesters as they are difficult to digest. Many wastewaters contain organic compounds that may be converted to biogas including municipal wastewater, food processing wastewater and many industrial wastewaters. Solid and semi-solid materials that include plant or animal matter can be converted to biogas.<a> (3. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/2.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="50%" height="50%">
                        <div class="clearfix"></div>
                        <b>Q. How is organic matter decomposed?</b>
                        <p class="mb-20"><b>A.</b> Organic matter anaerobically decomposed in the presence of bacteria. The bacterial decomposition of organic matter takes place in three phases namely hydrolysis, acid phase and methane phase. In the hydrolysis phase, heavier hydrocarbons are broken into smaller molecules, which are then converted to organic acids by acid forming bacteria. In the methane phase, fermentation of acids, hydrogen and CO2 produces methane.<a> (4. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <b>Q. Feed stock for cattle is varying from season to season. In respect to this, dung quality varies. By this factor, is there any effect on production of biogas?</b>
                        <p class="mb-20"><b>A.</b> Yes, but this effect is avoidable. There will be no much difference in gas production. . <a>(46. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. Can a sanitary toilet be linked with the biogas plant?</b>
                        <p class="mb-20"><b>A.</b> Yes, sanitary toilets can also be linked with biogas plant. The additional CFA of Rs. 1,200/- per plant as subsidy can be granted to biogas users.<a> (39. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. How the biogas can be used?</b>
                        <p class="mb-20"><b>A.</b> Biogas plant produces biogas and bio manure. Biogas can be used for thermal application like cooking, lighting and power generation through diesel/petrol gensets. Bio manure can be used as fertilizer in agriculture. Bio manure increases annual grain yield.<a> (6. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/3.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="50%" height="50%">
                        <div class="clearfix"></div>
                        <b>Q. What does the capacity of biogas plant mean?</b>
                        <p class="mb-20"><b>A.</b> The capacity of the biogas plant indicates how much biogas the plant produces in one day. For eg. 1 m3 biogas plant produces 1000 litres or 1 m3 (1 m3 = 1000 litres) of biogas in one day.<a> (MNRE)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. A biogas plant is fed with cattle dung and water in 1:1 ratio for getting biogas. In this situation, the technology couldn't be used in water scare areas.</b>
                        <p class="mb-20"><b>A.</b> Design of biogas plant on only fresh cattle dung has been developed approved by MNRE, GoI. In such plants, fresh cattle dung (16-18% solid content) is directly fed to biogas plant without mixing of water. This design is gaining popularity in desert districts of Rajasthan.<a> (48. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/4.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="50%" height="50%">
                        <div class="clearfix"></div>
                        <b>Q. Biogas production from both traditional and newly pre-fabricated type biogas plants are same. Which should be preferred & Why?</b>
                        <p class="mb-20"><b>A.</b> Life of brick masonry constructed biogas plants are around 20 years while life of prefabricated biogas plants are 10 years only. But the prefabricated biogas plants can be shifted as per the requirement. According to suitable condition, beneficiary can make his choice. <a>(25. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. Chemical fertilizers are easily available in market. Why do we choose a hard way for biogas slurry?</b>
                        <p class="mb-20">
                            <b>A.</b> The inorganic chemical fertilizers are harmful in the long run as they do not provide balanced diet to plants, severely affecting the physical, chemical and microbial properties of the soil. The impact of extensive use of inorganic fertilizer is shown as under - 
                            <ul>
                                <li>Destroys soil micro flora, especially the nitrogen-fixing bacteria.</li>
                                <li>Causes pollution of fresh water reserves.</li>
                                <li>Reduces soil porosity, aggregation and ultimately leads to infertility</li>
                                <li>Erodes top soil due wind because of missing organic matter in the soil.</li>
                                <li>It is not cost effective on long term basis. <a>(76. BDTC)</a></li>
                            </ul>
                        </p>
                        <div class="clearfix"></div>
                        <b>Q. Is it possible to replace inorganic fertilizers totally?</b>
                        <p class="mb-20"><b>A.</b> It is not possible as to totally replace inorganic fertilizers by biogas slurry use alone. We cannot meet the food needs of billion Indian people. However, to increase the quantity of food, we need to gradually change from inorganic to organic for sustainable returns.<a> (78. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. Does the biogas plant smell unpleasant?</b>
                        <p class="mb-20"><b>A.</b> In case of appropriate operation, a biogas plant does not release any bad odour into the environment. Hydrogen sulphide produced in the course of decomposition is converted to odourless elementary sulphur biologically or chemically in a closed space. Only incoming substrates (like manure, organic waste, etc.) can be a source of unpleasant smell. In the course of biogas production, microorganisms use the components of manure for their vital processes, which are responsible for bad smell, so the final product (fermentation effluent) is practically odourless, and it is a good-quality fertilizer for the vegetation.<a> (19. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. Is this gas poisonous?</b>
                        <p class="mb-20"><b>A.</b> Biogas shouldn't be breath. Due to its methane content (a flammable gas), it should be dealt with in a safe and secure manner. Some of the trace gases that make up about 1% or less of biogas are acidic and can be corrosive to certain kinds of metals and need to be dealt with carefully. <a>(91. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. Is a biogas facility dangerous?</b>
                        <p class="mb-20"><b>A.</b> A biogas plant is a closed system, and the biogas produced therein remains within the system, so if plant operation is done with due care and caution, neither the workers nor the environment is endangered. Even if methane escaped into the atmosphere there would be no serious explosion hazard, since methane is lighter than air. According to its characteristics, biogas mixes easily with air. An air biogas mixture containing 5% methane is explosive, but if a higher air concentration is reached (above 15%), biogas is not flammable anymore. The oxygen concentration in the anaerobic digesters is so low that the content is safe. <a>(90. BDTC)</a></p>
                    </div>
                </div>
            </div>
            <div id="benefits" class="tab-pane fade">
                <div class="box box-primary">
                    <div class="box-body faq-box">
                        <b>Q. What are the salient benefits of biogas technology?</b>
                        <p class="mb-20">
                            <b>A.</b> It provides clean gaseous fuel for cooking and lighting.
                            <ul>
                                <li>Digested slurry from biogas plants is used as enriched bio-manure to supplement the use of chemical fertilizers.</li>
                                <li>It improves sanitation in villages and semi -urban areas by linking sanitary toilets with biogas plants.</li>
                                <li>Biogas plants help in reducing the causes of climate change.<a> (7. BDTC)</a></li>
                            </ul>
                        </p>
                        <div class="clearfix"></div>
                        <b>Q. Can biogas be used in place of fossil fuels? How?</b>
                        <p class="mb-20"><b>A.</b> Methane is the principal gas in biogas. Methane is also the main component in natural gas, a fossil fuel. Biogas can be used to replace natural gas in many applications including: cooking, heating, steam production, electrical generation, vehicular fuel, and as a pipeline gas. <a>(10. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. What happens to raw materials after biogas production? </b>
                        <p class="mb-20"><b>A.</b> Despite the common opinion that the amount of input raw material to fermentation corresponds to the volume of raw material after it, the quality of the raw material improves (virtually no odour, improved fertilizer properties, reduced organic loading and degree of contamination). The raw material can be divided into solid and liquid fractions, it can also be used as organic bio fertilizer for fields.<a> (MNRE)</a> </p>
                        <div class="clearfix"></div>
                        <b>Q. Chemical fertilizers are easily available in market. Why do we choose a hard way for biogas slurry?</b>
                        <p class="mb-20">
                            <b>A.</b> The inorganic chemical fertilizers are harmful in the long run as they do not provide balanced diet to plants, severely affecting the physical, chemical and microbial properties of the soil. The impact of extensive use of inorganic fertilizer is shown as under - 
                            <ul>
                                <li>Destroys soil micro flora, especially the nitrogen-fixing bacteria.</li>
                                <li>Causes pollution of fresh water reserves.</li>
                                <li>Reduces soil porosity, aggregation and ultimately leads to infertility</li>
                                <li>Erodes top soil due wind because of missing organic matter in the soil</li>
                                <li>It is not cost effective on long term basis. <a>(76. BDTC)</a></li>
                            </ul>
                        </p>
                        <div class="clearfix"></div>
                        <b>Q. Economically wise which biogas plant is better to install?</b>
                        <p class="mb-20"><b>A.</b> The cost of installation of the floating drum type biogas plant is about 20-30% higher than of a fixed dome type plant. Maintenance of floating drum biogas plant is also higher than fixed dome biogas | plant as the steel drum of the gas holders require painting at least once a year.<a>(93. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/5.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="25%" height="25%">
                        <div class="clearfix"></div>
                        <b>Q. How much energy is contained by biogas?</b>
                        <p class="mb-20"><b>A.</b> One cubic meter biogas is equivalent to about 4700 kCal energy.<a>(14. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. For an 8 members family, what will be the capacity of the biogas plant to meet their daily energy requirements?</b>
                        <p class="mb-20"><b>A.</b> Approximately 0.24 cum biogas is consumed by a person daily for completing his cooking needs. According to this, a total of 1.92 cum biogas is required for complete daily cooking needs. 2 cum biogas plant is the standard design next after the 1.92 cum biogas, so the appropriate size of the biogas plant would be 2 m<sup>3</sup>.<a>(17. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. How much cattle dung is required daily for feeding of different sizes of biogas plant? <a>(20. BDTC)</a></b>
                        <p class="mb-20"><b>A.</b> </p>
                        <div class="col-md-8">
                            <table class="table table-bordered mb-20">
                                <thead>
                                    <th rowspan = "2">Size of biogas plant (m<sup>3</sup>)/day</th>
                                    <th rowspan = "2">Amount of wet dung required daily (kg)</th>
                                    <th colspan = "2"> Approximate numbers of adult cattle heads</th>
                                    <tr>
                                        <th> Local </th>
                                        <th> Cross breed </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>25 </td>
                                        <td>2-3</td>
                                        <td>1-2</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>50 </td>
                                        <td>4-5</td>
                                        <td>2-3</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>75 </td>
                                        <td>6-7</td>
                                        <td>3-4</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>100 </td>
                                        <td>8-10</td>
                                        <td>4-5</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>150 </td>
                                        <td>12-14</td>
                                        <td>6-8</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <b>Q. What are the environmental impacts of producing/using biogas?</b>
                        <p class="mb-20"><b>A.</b> One of the gases produced by the decomposition of slurry is methane gas, which is estimated to trap 20 to 30 times as much atmospheric heat as carbon dioxide and reducing methane releases into the air is a crucial element of fight to limit the global warming. The important substance for plant growth is nitrogen, which remains in place after extraction of biogas. This leads to further environmental advantages. By reducing the weight and volume of fertilizer and increasing the amount of fertilizer available from composted waste reduces the need for chemical fertilizers, which release the extremely powerful greenhouse gas nitrous oxide.<a>(12. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/6.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="25%" height="25%">
                        <div class="clearfix"></div>
                        <b>Q. Does biogas contribute to climate change?</b>
                        <p class="mb-20"><b>A.</b> During combustion of biogas, carbon dioxide (C02) is released that is reabsorbed by plant matters for their growth. Carbon in biogas comes from plant matter that fixed this carbon from atmospheric C02. Thus, biogas production is carbon-neutral and does not add to greenhouse gas emissions. Further, any consumption of fossil fuels replaced by biogas will lower CO2 emissions.<a>(13. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <b>Q. How can we compare the quality of biogas equivalent to other hydrocarbon fuels? </b>
                        <p class="mb-20"><b>A.</b> Quantities of various hydrocarbon fuels that will have energy equivalent to 1m3 of biogas are given in as under <a>(15. BDTC)</a> </p>                        
                        <div class="col-md-8">
                            <table class="table table-bordered mb-20">
                                <thead>
                                    <th>Name of the fuel</th>
                                    <th>Kerosene</th>
                                    <th>Firewood</th>
                                    <th>Cow dung</th>
                                    <th>Charcoal</th>
                                    <th>Furnace oil</th>
                                    <th>Electricity</th>
                                    <th>LPG</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Equivalent quantity to 1m3 of biogas</td>
                                    <td>0.60 lit.</td>
                                    <td>3.50 kg</td>
                                    <td>12.3kg</td>
                                    <td>1.50 kg</td>
                                    <td>0.40 lit.</td>
                                    <td>4.70kWh</td>
                                    <td>0.43 kg</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <b>Q. What are the quantities of biogas consumption for its different applications? </b>
                        <p class="mb-20"><b>A.</b> Consumption of biogas is mentioned as under <a>(16. BDTC)</a></p>
                        <div class="col-md-6">
                            <table class="table table-bordered mb-20">
                                <thead>
                                    <th>S.N.</th>
                                    <th>Application</th>
                                    <th>Consumption </th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Cooking</td>
                                    <td>0.25m<sup>3</sup>/person/day</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Lighting</td>
                                    <td>0.13m<sup>3</sup>/hour/lamp</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Engine operation</td>
                                    <td>0.5m<sup>3</sup>/hour/horse power</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div id="om" class="tab-pane fade">
                <div class="box box-primary">
                    <div class="box-body faq-box">
                        <b>Q. How difficult is it to run a biogas plant?</b>
                        <p class="mb-20"><b>A.</b> A biogas plant is like an animal. You must feed it every day and feed it with appropriate feedstock in the adequate amount. Just like an animal if you don’t take good care of it, it will become ill and will yield poor results. <a>(MNRE)</a></p>
                        <b>Q. What are the optimum conditions for the biogas plant to operate?</b>
                        <p class="mb-20"><b>A.</b> The temperature should be in the range of 35 to 38 °C with the input slurry pH of 6.5 to 7.5. In the low temperature regions either hot water can be added to the input slurry or the digester can be insulated with a hot water jacket.<a>(MNRE)</a></p>
                        <b>Q. How waste should be fed to the biogas plant?</b>
                        <p class="mb-20"><b>A.</b> The feedstock should be mixed with water in the ratio of 1:1, made into slurry form and then can be fed to biogas plant. It majorly depends on the total solids content of waste materials. The optimum total solids content of the waste material should be 8-10% for the better activity of microorganisms. <a>(MNRE)</a></p>
                        <b>Q. Whether biogas can be directly used in engines?</b>
                        <p class="mb-20"><b>A.</b> No. The biogas has to be purified by removing the Carbon dioxide and Hydrogen Sulphide using scrubbing process and then it can be used in engines.<a>(MNRE)</a></p>
                        <b>Q. Is it safe to use biogas in kitchen?</b>
                        <p class="mb-20"><b>A.</b> Yes. The density of biogas is lesser than the density of air. Hence, the chance of fire accident is very much lower compared to LPG.<a>(MNRE)</a></p>
                        <b>Q. Can LPG burner be converted to burn biogas? Can it be used at the same time?</b>
                        <p class="mb-20"><b>A.</b> LPG stoves can be modified to fit the properties of biogas but the efficiency will often not be as good as with a genuine biogas stove. However, this should be done only by a technical expert.<a>(40. BDTC & MNRE)</a> </p>
                        <b>Q. How many days the running plant can be leave without daily feeding?</b>
                        <p class="mb-20"><b>A.</b> Under special circumstances, the running plant can be kept for 30 to 40 days without feeding but its gate valve should be well closed.<a>(MNRE)</a> </p>
                        <b>Q. Feed stock for cattle is varying from season to season. In respect to this, dung quality varies. By this factor, is there any effect on production of biogas?</b>
                        <p class="mb-20"><b>A.</b> Yes, but this effect is avoidable. There will be no much difference in gas production.<a>. (46. BDTC)</a> </p>
                        <b>Q. Plants initially gives good gas, after some time it goes low, how do we keep it under control?</b>
                        <p class="mb-20"><b>A.</b> Deenbandhu is better for long run use but water should not be more in the slurry. Complete slurry movement in the large tank should be done regularly. The amount of Daily feeding should be controlled rather than uniform feeding. Pipe Joints, gate volve, connection of stove should always be checked.<a>(MNRE)</a></p>
                        <b>Q. Why methane produced better in the absence of air (anaerobically)?</b>
                        <p class="mb-20"><b>A.</b> Most bacteria grow more rapidly when they have a source of oxygen. When they run out of “free oxygen” in the air, some can obtain it from other compounds. Bacteria which use these compounds produce methane gas (CH4) as a waste product.<a>(24. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/7.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="60%" height="60%">
                        <div class="clearfix"></div>
                        <b>Q. The above said biogas burners are not commonly available in the retail market. From where it can be purchased? Are there any Govt. approved vendors?</b>
                        <p class="mb-20"><b>A.</b> Presently there are no government approved vendors but there is a list of manufactures that are certified by ISI and KVIC. They may address their dealers nearer to beneficiary's location. Beneficiary must visit to MNRE website, respective state nodal agency or BDTC's for the list. <a>(41. BDTC)</a></p>
                        <b>Q. How the excess biogas can be utilized?</b>
                        <p class="mb-20"><b>A.</b> Excess biogas can be stored in balloons for use in near future. But while using stored biogas, calculated amount of dead weight such as scraped tyre, gunny bags filled with sand etc. could be used to create pressure.<a>(42. BDTC) </a></p>
                        <b>Q. How to identify the leakage of biogas from the plant? </b>
                        <p class="mb-20"><b>A.</b> A solution of soap is made and applied over the dome. In case of cracks in the dome, there will be formation of bubbles indicating the leakage of biogas.<a>(MNRE)</a> </p>
                        <b>Q. If a biogas plant stops generation of gas, how a farmer can detect the reason?</b>
                        <p class="mb-20"><b>A.</b> There are a number of things that can affect the biogas production in a biodigester.</p>
                        <ul>
                            <li>A. Biogas leaks</li>
                            <p class="mb-20">If there is very little biogas, there may be a leak somewhere. The biogas gas holder and biogas pipeline should be checked for leakage. A simple soap solution can be used to detect the leakage.</p>
                            <li>B. Temperature problems</li>
                            <p class="mb-20">If ambient temperatures reach below 200C, you will experience a drastic decrease in biogas production. If this is the case, look to adapt a heating system to your biodigester. </p>
                            <li>C. Problems with the biodigester's pH</li>
                            <p class="mb-20">The pH in the biodigester tank should be as close to neutral as possible. Since the anaerobic processes in a biodigester produce acids. The most common pH problem is one of acidity. Beneficiary can do a simple litmus test on the biodigesters content. If the results are below 7, beneficiary must add a small amount of lime or grounded lime stone to normalize the digester's pH. Since excessive amounts of lime will not be soluble in the mixture and may harm the bacteria, beneficiary should never exceed a lime concentration of 500mg for every litre of mixture in the biodigester tank.</p>
                            <li>D. Other problems</li>
                            <p class="mb-20">There are a number of other problems that can arise during the life of a biodigester. To investigate problems, it is best to think back to the basics of what makes a biodigester work (organic material, strong seals, warmth) and eliminate anything else that could possibly harm its functioning. For example be careful not to introduce unnecessary chemicals into the tank, and try not to use livestock that has recently been given antibiotics or other medications, for these chemicals present in the manure may cause damage to the bacteria in the biodigester tank. Also, make sure to use non-corrosive materials for handling the gas and water. Cement and plastic cause no harm to the mixture in the tank, but metals should be avoided for use in the tank, or any of the tubing through which the biogas travels.<a>(58. BDTC)</a> </p>
                        </ul>
                        <b>Q. How can we examine Deenbandhu gas dome for leak?</b>
                        <p class="mb-20"><b>A.</b> It’s a slight tough task than KVIC gas holder. The gas storage dome can be examined by fixing a U-shaped safety valve made of glass tube at the gas outlet pipe and then filling the digester with water or inflating with air using a manually operated air pump to make the column of water in safety valve rise to at least 90 cm. After 24 hours, the water column should be checked for a drop in level. If water column drops or gas escapes, the leak must be located by pouring soap water on all suspected locations outside the gas chamber and around the gas vent pipe joints. <a>(60. BDTC)</a></p>
                        <b>Q. How can we examine KVIC gas holder for gas leak?</b>
                        <p class="mb-20"><b>A.</b> The steel gas holder should be tested for gas leaks by keeping water in it overnight. It can be put to a smoke test by burning a cloth dipped in kerosene inside the holder and watching for the smoke coming out of any joints. Only the tested and painted gas holder should be placed on the digester.<a>(59. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/8.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="20%" height="20%">
                        <div class="clearfix"></div>
                        <b>Q. Is it possible to flow back of fire from the burner? If this happens, the biogas plant may cause fire accident.</b>
                        <p class="mb-20"><b>A.</b> Flow back of fire might be possible. In order to stop accidental flow back of fire from burner to gas holder, a flame arrester must be incorporated in the pipe line as a safety device.<a>(55. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/9.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <b>Q. Is there any general procedure for initially feed the biogas plant?</b>
                        <p class="mb-20"><b>A.</b> Fill the plant with a correct mixture of dung slurry (dung and water in ratio 1:1) through the inlet chamber. The gas pipe should be disconnected. The digester should not be filled to more than 75 - 80% of its volume, under any circumstances thus allowing some volume for storage of gas. The quantity of slurry recommended for the particular size of plant should be added daily.<a>(61. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/10.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/11.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <b>Q. Can biogas be fed just after the initial feeding? Is it the right way?</b>
                        <p class="mb-20"><b>A.</b> The slurry should be added only after the production of inflammable gas has started, i.e. after about 20 days from initial filling of the plant up to the recommended level. The stirring can be done in a fixed dome plant by moving a bamboo pole up and down in the inlet and outlet openings. This will help in breaking of scum if done at least once a day.<a>(63. BDTC)</a></p>
                        <b>Q. Is the first gas flammable?</b>
                        <p class="mb-20"><b>A.</b> The production of gas after filling of the gas chamber would take about 7-20 days. The initial gas stored may not be combustible and should be allowed to escape. Purge air from all delivery lines by allowing gas to flow out prior to first use. Ensure that condensed water is able to flow out from the pipeline through the water trap.<a>(62. BDTC)</a> </p>
                        <b>Q. Are digesters cold or hot?</b>
                        <p class="mb-20"><b>A.</b> The optimum temperature for bacteria to remain alive and multiply is above 30 to 38 degrees Celsius. Digesters can also work at temperatures that are both lower and higher than this. Because the bacteria working in the digester are very sensitive to temperature, cooler digesters take more time to break down the biodegradable feedstock, while hotter ones may not break down the biodegradable feedstock due to bacteria remaining in dormant stage.<a>(64. BDTC)</a> </p>
                        <b>Q. In the winter season, with a drop in temperature, production of biogas also drops. In such situation what would we do for optimum production?</b>
                        <p class="mb-20"><b>A.</b> Following tips may be useful-</p>
                        <ul>
                            <li> Warm water from solar water heaters can be used for dilution of dung.</li>
                            <li> Diluted dung slurry can be prepared in the mixing tank and kept all day to warm up. Then the digester may be loaded in the evening.</li>
                            <li> Addition of organic matter containing high percentage of nitrogen like urine, night soil etc.</li>
                            <li> The gas holder should be covered with plastic sheets in day so the digester temperature can be increased. During night time, the same will be covered with gunny bags that remains insulated and heat loss can be minimised.</li>
                            <li> The digester should be recycled along with fresh slurry in order to increase the bacterial population in the digester.<a>(65. BDTC)</a> </li>
                        </ul>
                        <b>Q. Is there any waste treatment to be followed for slurry disposal? </b>
                        <p class="mb-20"><b>A.</b> The slurry need not be treated and can be directly disposed of to the agricultural field or shade dried and made into pellets for storage purposes.<a>(MNRE)</a> </p>
                        <b>Q. As the biogas plant is charge with fresh slurry, a black liquid is discharge from opposite side. What is that liquid? </b>
                        <p class="mb-20"><b>A.</b> That liquid is digested slurry. This slurry is a natural substance used for enriching the soil. It is a by-product obtained from the biogas plant after the digestion of dung or other organic matter.<a>(66. BDTC)</a> </p>
                        <b>Q. How is biogas slurry beneficial? How to use the slurry? </b>
                        <p class="mb-20"><b>A.</b> Biogas slurry is free from weed seeds, foul smell and pathogen. It contents major plant nutrients which nourish the soil to accelerate the growth of plants, especially for root growth which enhances crop yield in a sustainable manner. It enhances the aeration and water holding capacity of soil for root penetration resulting in better growth.<a>(67. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/12.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <b>Q. Generally, it is saying that application of biogas slurry is good. What are the scientific points behind this statement? </b>
                        <p class="mb-20"><b>A.</b> The application of biogas slurry enhances the fertility of the soil to optimize quality production. Secondary, its dark colour, absorbs more sunlight which results warming up of soil. <a>(68. BDTC)</a></p>
                        <b>Q. Is it best to apply liquid slurry to crop? </b>
                        <p class="mb-20"><b>A.</b> Yes, application of liquid slurry to crop is one of the best methods for increasing overall yield. Some advantages are mentioned as under- </p>
                        <ul>
                            <li> It has better nitrogen component compared to dry and semi dry slurry. </li>
                            <li> It acts as a soil conditioner. Aggregated soil communicates the absorption of the slurry. Moreover the bacteria and fungi growth is enhanced on application of biogas slurry, which is crucial for plant crop yield. </li>
                            <li> Good for acidic soils. </li>
                            <li> Reduces harmful elements like aluminium and minimizes toxicity. </li>
                            <li> Supplies nutrients to beneficial microbes. </li>
                            <li> Changes membrane permeability of root hairs and enhances nutrient uptake. </li>
                            <li> The water holding capacity of the soil increases. <a>(69. BDTC)</a></li>
                        </ul>
                        <b>Q. Handling of liquid slurry is not more convenient. Are there any machines available for handling?</b>
                        <p class="mb-20"><b>A.</b> Liquid biogas slurry can be handled with equipments or manually. The equipment becomes necessary for community biogas plant, which yield large quantity of slurry. It is therefore necessary to develop suitable equipment for handling the slurry and for field application. A few equipments which are in use at different places are as follows: </p>
                        <ul>
                            <li> Low cost wheel barrow </li>
                            <li> Slurry injector </li>
                            <li> Slurry cart </li>
                            <li> Slurry tanker </li>
                        </ul>
                        <p class="mb-20"> For the effective use of slurry, a beneficiary must use the liquid slurry as far as possible. After the application of liquid slurry, excess slurry can be dried in open sun condition. The dried slurry can be converted in to powder form by hitting wooden bamboos. The dried powder can be used in the next sowing period.<a>(70. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/13.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/14.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="70%" height="70%">
                        <div class="clearfix"></div>
                        <b>Q. Is there any other method for storing and transporting the biogas liquid slurry?</b>
                        <p class="mb-20"><b>A.</b> From the outlet of the tank, a channel leads Biogas slurry to a filter bed with opening at both ends. A compact layer of green or dry leaves is made in the filter bed. Biogas slurry flows down and gets filtered allowing the preparing fresh slurry. The semi solid residue left on top of the bed can be transported and stored in a pit use when required. <a>(71. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/15.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <b>Q. Is there any harm in handling the slurry manually? </b>
                        <p class="mb-20"><b>A.</b> No. there is no harm in handling the slurry manually as it is free from pathogens which otherwise causes diseases. Most of the harmful organisms like eggs of hookworms are killed in the process of anaerobic digestion. Moreover, the pathogen, which pollutes the ground water gets eliminated. <a>(72. BDTC)</a></p>
                        <b>Q. What are different types of Biogas slurry? </b>
                        <p class="mb-20"><b>A.</b> Liquid biogas slurry: It has a solid content about 6%, pH value of about 8 to 9 and nitrogen 1.8% along with other nutrients. This is the best form for use. Semi Dried biogas slurry: It is with solids varying from 15 to 20%, pH value varies from 7 to 9%.This is the next best form for use. Dry biogas slurry: The slurry coming out from the plant remains in drying pit for some period without application. The solids vary from 50 to 70% and the pH value from 7 to 8. Dry slurry micronutrients but very less as it lost if sun dried.<a>(73. BDTC)</a> </p>
                        <b>Q. When dung and other fertilizers are available than why biogas slurry alone is preferred?</b>
                        <p class="mb-20"><b>A.</b> Fermentation reduces the C/N ratio by removing some of the carbon, which has the advantage of increasing the fertilizing effect. Another favourable effect is that nitrogen and other plant nutrients become mineralizes and hence more readily available to plants. Moreover, well digested slurry is practically odourless, easier to spread and does not attract weeds and insects flies. The following table indicates how biogas slurry is more effective than other organic slurries in relation to NPK.<a>(74. BDTC)</a> </p>
                        <div class="col-md-8">
                            <table class="table table-bordered mb-20">
                                <thead>
                                    <th>SI.NO.</th>
                                    <th>Slurry</th>
                                    <th>% content N2</th>
                                    <th>% content P2O5</th>
                                    <th>% content K2O</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Fresh cattle dung</td>
                                    <td>0.3-0.4</td>
                                    <td>0.1-0.2</td>
                                    <td>0.1-0.3</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Farmyard slurry</td>
                                    <td>0.4-1.5</td>
                                    <td>0.3-0.9</td>
                                    <td>0.3-1.9</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Compost</td>
                                    <td>0.5-1.5</td>
                                    <td>0.3-0.9</td>
                                    <td>08.-1.2</td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Biogas slurry</td>
                                    <td>1.5-2.5</td>
                                    <td>1.0-1.5</td>
                                    <td>0.8-1.2</td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Poultry slurry</td>
                                    <td>1.0-1.8</td>
                                    <td>1.4-1.8</td>
                                    <td>0.8-0.9</td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>Cattle urine</td>
                                    <td>0.9-1.2</td>
                                    <td>Trace</td>
                                    <td>0.5-1.0</td>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <td>Paddy straw</td>
                                    <td>0.3-0.4</td>
                                    <td>0.8-1.0</td>
                                    <td>0.7-0.9</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <b>Q. What are the differences in the uses of biogas slurry and urea in general?</b>
                        <p class="mb-20"><b>A.</b> The differences are as under <a>(75. BDTC)</a>:</p>
                        <div class = "col-md-6">
                            <table class="table table-bordered mb-20">
                                <thead>
                                    <th>S.NO.</th>
                                    <th>Biogas slurry</th>
                                    <th>Urea</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Balances Nourishment</td>
                                    <td>Imbalanced Nourishment</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Pollution free</td>
                                    <td>Causes pollution of water, air etc.</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Eco Friendly</td>
                                    <td>Damage to the Ecology</td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Defense against pests</td>
                                    <td>Vulnerable to pests</td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Can be made at home</td>
                                    <td>To be bought from outside only</td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>Cost effective</td>
                                    <td>Fluctuating cost</td>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <td>Needs less water</td>
                                    <td>Needs more water</td>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <td>Maintains soil fertility</td>
                                    <td>Spoils the soil strength</td>
                                </tr>
                                <tr>
                                    <td>9.</td>
                                    <td>No side effect</td>
                                    <td>Many adverse effects</td>
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <td>Quality food</td>
                                    <td>Less healthy food</td>
                                </tr>
                                <tr>
                                    <td>11.</td>
                                    <td>Better health</td>
                                    <td>Poor health</td>
                                </tr>
                                <tr>
                                    <td>12.</td>
                                    <td>Wholesome</td>
                                    <td>One-sided</td>
                                </tr>
                                <tr>
                                    <td>13.</td>
                                    <td>Less yield but sustainable returns</td>
                                    <td>More yield and quick returns</td>
                                </tr>
                                <tr>
                                    <td>14.</td>
                                    <td>Increasing returns</td>
                                    <td>Diminishing returns</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/16.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="50%" height="50%">
                        <div class="clearfix"></div>
                        <b>Q. What is the difference between composting & biogas slurry? <a>(77. BDTC)</a></b>
                        <p class="mb-20"><b>A.</b> </p>
                        <div class ="col-md-8">
                            <table class="table table-bordered mb-20">
                                <thead>
                                    <th>S.NO.</th>
                                    <th>Composting</th>
                                    <th>Biogas slurry</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Unselective degradation by both aerobic and anaerobic microbes causing more weight loss without proportional enrichment of fertilizer value. Both carbon and nitrogen are consumed during degradation.</td>
                                    <td>Selection anaerobic digestion. Weight loss is less. Mainly carbon is consumed for producing methane.</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Proper degradation time is 90 to 120 days.</td>
                                    <td>Proper degradation time is 30-40 days.</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>About 30 -40 % Nitrogen is lost due to evaporation of Ammonia</td>
                                    <td>Loss by evaporation is negligible.</td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Compost has bad odour.</td>
                                    <td>Odour is minimized.</td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Some quantity is blown off by wind.</td>
                                    <td>No such loss.</td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>N is less</td>
                                    <td>N, P, K is comparatively more.</td>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <td>Compost has limited macro and micro nutrients.</td>
                                    <td>Biogas slurry has more macro and micro nutrients.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/17.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="50%" height="50%">
                        <div class="clearfix"></div>
                        <b>Q. Which combination with biogas slurry yields better results? </b>
                        <p class="mb-20"><b>A.</b> Biogas slurry along with Gypsum and NPK is showing significant results in the production of crops compared to other combinations. <a>(79. BDTC)</a> </p>
                        <b>Q. Today, I am switching over to biogas slurry from fertilizers. I think, I will get more yield from today. Is it right? </b>
                        <p class="mb-20"><b>A.</b> There will be no instant increase in production due to the switch over. In fact, initially there will be decrease in the yield. But over a period of two to five years, there will be an increase in the quantity and quality of the yield.<a>(80. BDTC)</a> </p>
                        <b>Q. What are the other uses of biogas slurry? </b>
                        <p class="mb-20"><b>A.</b> Biogas slurry is also being used for fish culture, which acts as a supplementary feed. On an average 15-25 litres wet slurry can be applied per day in a 1200 sq. ft. pond. Biogas slurry mixed with oil cake or rice bran in 2:1 ratio increased the fish production remarkably. Biogas slurry can be also used for the production of bio fertilizers like Azolla and aquatic biomass Spirulina. <a>(81. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/18.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="25%" height="25%">
                        <div class="clearfix"></div>
                        <b>Q. What are the benefits of other nutrients in biogas slurry? </b>
                        <p class="mb-20"><b>A.</b> It was noticed from 2 samples of soil collected-one from biogas slurry paddy cultivated land and another from chemically applied land that the bacterial count was 23.3 % more in the slurry applied soils than in the chemical applied soils, resulting in> Increase of micronutrients in the soil. </p>
                        <ul>
                            <li> Improved drainage and better aeration to the root system. </li>
                            <li> Improvement in the soil structure. </li>
                            <li> Strong Immune system. </li>
                            <li> Less number of weeds. </li>
                            <li> Less Methane exposure. </li>
                            <li> Qualitative improvement in taste, smell, size, colour etc. <a>(82. BDTC)</a></li>
                        </ul>
                        <b>Q. Why we need to manage the use of Biogas slurry? </b>
                        <p class="mb-20"><b>A.</b> The management of slurry is very important in the effective utilization. At present the users just allow biogas slurry to enter lower surface areas resulting in loss of nitrogen. The slurry will be effective if only farmer uses it properly. The farmers are still not aware of the value of biogas slurry and resort to the traditional ways of using the biogas slurry with the agriculture/farm/ cattle waste.<a>(83. BDTC)</a> </p>
                        <b>Q. Whether biogas slurry can be used daily/fortnightly/ monthly basis? </b>
                        <p class="mb-20"><b>A.</b> Yes. It can be used as needed depending on the species grown / compost preparation and its availability. </p>
                        <ul>
                            <li><b> Daily: </b></li>
                            <p> Biogas slurry can be applied daily in kitchen gardens, for vegetables and horticultural plants, this act as a soil conditioner. The biogas slurry can be directly connected to an irrigational channel or applied while watering the plants. However, a study to evolve a proper system to meet the requirement of different crops based on the output and fertility of soil is necessary. </p>
                            <li><b> Fortnight/Weekly: </b></li>
                            <p> Storage capacity, availability of biomass for compost making and alternate methods for use of biogas slurry through pelletization are to be considered for fortnight/weekly applications. For dry land and cash crops, the slurry can be applied weekly/fortnight. </p>
                            <li><b> Monthly: </b></li>
                            <p> For paddy and horticultural plants biogas slurry can be used periodically where the application of inorganic fertilizer is less as it is a better substitute without detriment to the yield.<a>(84. BDTC)</a> </p>
                        </ul>
                        <b>Q. How much quantity of digested slurry can be added into fresh slurry? </b>
                        <p class="mb-20"><b>A.</b> For about 100 litres of fresh slurry about 2 litres of digested slurry can be added. This will speed up and increase gas production. <a>(85. BDTC)</a></p>
                        <b>Q. What are the common operational problems generally encountered with biogas plant?<a>(86. BDTC)</a>  </b>
                        <p class="mb-20"><b>A.</b> </p>
                        <div class = "col-md-8">
                            <table class="table table-bordered mb-20">
                                <thead>
                                    <th>Defect.</th>
                                    <th>Cause</th>
                                    <th>Remedy</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>No gas after the first filling of the plant.</td>
                                    <td>Lackof time.</td>
                                    <td>It may take 3 -4 weeks</td>
                                </tr>
                                <tr>
                                    <td>Slurry level does not rise in inlet and outlet chambers <br><br> even though gas is being produced.</td>
                                    <td>i.    Gas pipe blocked by water condensate. <br><br> ii.    Insufficient pressure. <br><br>iii.    Gas outlet blocked by scum.</td>
                                    <td>a.    Add more slurry.<br><br>b.    Check and correct<br><br>c.    Rotate the agitated slurry with a wood pole.</td>
                                </tr>
                                <tr>
                                    <td>No gas at stove but plenty <br><br> in the plant.</td>
                                    <td>i.    Gas pipe blocked by water condensate. <br><br> ii.    Insufficient pressure. <br><br> iii.    Gas outlet blocked by scum.</td>
                                    <td>a. Remove water condensate from moisture trap.<br><br> b. Increase weight on gasholder.<br><br>c. Disconnect the outlet valve from the hosepipe and clean it by pouring water.</td>
                                </tr>
                                <tr>
                                    <td>Gas does not burn.</td>
                                    <td>Wrong kind of gas</td>
                                    <td>Add properly mixed slurry</td>
                                </tr>
                                <tr>
                                    <td>Flame far from burner.</td>
                                    <td>Pressure too high or deposition of carbon on the nozzle.</td>
                                    <td>Adjust gas outlet valve and clean nozzle.</td>
                                </tr>
                                <tr>
                                    <td>Flame dies quickly</td>
                                    <td>Insufficient pressure</td>
                                    <td>Check quantity of gas. Increase pressure by breaking the scum by stirring the slurry.</td>
                                </tr>
                                <tr>
                                    <td>Unsanitary condition around biogas unit.</td>
                                    <td>-    Improper digestion <br><br>-    Improper disposal of slurry</td>
                                    <td>-    Add correct quantity of slurry <br><br> -    Use slurry for composting of crop residues</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <b>Q. What are the maintenances and general care must be taken up after installation of a biogas plant? </b>
                        <p class="mb-20"><b>A.</b> </p>
                        <ul>
                            <li> Daily </li>
                            <ul>
                                <li> Add dung slurry to the plant. Keep ratio of dung and water as 1:1. </li>
                                <li> Make sure that no stones and sand is getting into the plant during feeding. </li>
                                <li> Clean the gas burner. </li>
                                <li> The water traps should always contain water otherwise the gas will leak out through the gas trap. </li>
                            </ul>
                            <li> Monthly </li>
                            <p> Check gas pipeline for leaks with a soap solution. </p>
                            <li> Annually </li>
                            <ul>
                                <li> Check for gas and water leaks and repair them. </li>
                                <li> Check gas pipelines for leakages. </li>
                                <li> At intervals of 5-6 years, check for any solid sediment at the bottom of the digester plant by inserting a long stick in the plant and determining the change in depth. </li>
                                <P> It should be completely emptied to allow for removal of the solids and plastering of the inside portion of the plant. Take the necessary safety precautions when performing this task.<a>(87. BDTC)</a> </P>
                            </ul>
                        </ul>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/19.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="50%" height="50%">
                        <div class="clearfix"></div>
                        <b>Q. What are the safety measures to be taken during the operation of the biogas plant? </b>
                        <p class="mb-20"><b>A.</b> Safety measures for floating drum type biogas plant are mentioned as under- </p>
                        <ul>
                            <li> It is essential that all the air in the gas holder is released to environment whenever the holder is removed for cleaning, painting and any other purpose. </li>
                            <li> Do not weld the gas holder when it full of gas. </li>
                            <li> Corrosion of the gas holder should be avoided by water jacket seal. </li>
                        </ul>
                        
                        <p> Safety measures for fixed dome type biogas plant the mentioned as under- </p>
                        <ul>
                            <li> The main gas outlet valve at the top of the dome must be kept open while feeding dung slurry into the plant for the first time after installation or during the cleaning of the plant. </li>
                            <li> Gas must not be lighted at the main valve on the top of the dome. Otherwise sometimes due to negative pressure or back fire, explosion can take place resulting in damage to the dome and other part of the plant. </li>
                            <li> Inlet and outlet chambers should be covered firmly with stone or concrete slab to prevent children or animals falling in accidently. <a>(88. BDTC)</a></li>
                        </ul>
                        <b>Q. Are there any other safety measures? </b>
                        <p class="mb-20"><b>A.</b> Other safety measures are- </p>
                        <ul>
                            </li> Check the right position of flame arrester in the pipe line and change it over the period. </li>
                            </li> If there is a smell of unburnt gas due to leakage, then the gas must not be lighted and doors and windows should be open to let the gas dissipate. </li>
                            </li> Sometimes the upper layer of digested slurry gets dried up but lower remains watery. Nobody should be allowed to walk on the slurry as it may give way and the individual can sink into the plant.<a>(89. BDTC)</a> </li>
                        </ul>
                        <b>Q. Is there any other composition in biogas? </b>
                        <p class="mb-20"><b>A.</b>Some properties of noxious gases present in biogas are given in below Table. <a>(92. BDTC)</a></p>
                        <div class = "col-md-6">
                            <table class="table table-bordered mb-20">
                                <thead>
                                    <th rowspan = "2">Gas</th>
                                    <th colspan = "2">Explosive range</th>
                                    <th rowspan = "2">Physiological effect</th>
                                    <tr>
                                        <th>Minimum (%)</th>
                                        <th>Maximum (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Ammonia</td>
                                    <td>16</td>
                                    <td>-</td>
                                    <td>Irritant</td>
                                </tr>
                                <tr>
                                    <td>Carbon di oxide</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>Asphyxiate</td>
                                </tr>
                                <tr>
                                    <td>Hydrogen sulphide</td>
                                    <td>4</td>
                                    <td>46</td>
                                    <td>Poison</td>
                                </tr>
                                <tr>
                                    <td>Methane</td>
                                    <td>5</td>
                                    <td>15</td>
                                    <td>Asphyxiate</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <b>Q. It is claimed that bio CNG is better than conventional CNG. What does Bio-CNG mean? </b>
                        <p class="mb-20"><b>A.</b> Bio - CNG means methane gas derived from organic material. It is identical in properties to natural gas, but it is not derived from fossil fuels. Bio - CNG can be produced from biogas which has been cleaned or upgraded to meet natural gas specifications, by the removal of gases such as CO2 and hydrogen sulphide to leave an almost pure (90 - 98%) methane gas.<a>(94. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/20.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="50%" height="50%">
                        <div class="clearfix"></div>
                        <b>Q. What will be the major application area for Bio-CNG? </b>
                        <p class="mb-20"><b>A.</b> Bio - CNG can be injected into the gas network or I compressed for use in natural gas vehicles. Once fed in the gas network, it can provide domestic or commercial cooking and heating, or be used as vehicle fuel in locations remote from the source of I the gas.<a>(95. BDTC)</a> </p>
                        <b>Q. Is Biogas a kind of renewable energy? </b>
                        <p class="mb-20"><b>A.</b> Yes, anaerobic digester technology is employed world-wide to create renewable energy. Biogas produced from an anaerobic digester is comprised primarily of methane gas, which can be used instead of fossil fuels to produce energy. This "renewable natural gas" can substitute fossil fuel natural gas for any need including heating, cooking and motive power. Biogas can also be used as fuel to make clean electricity. All of these options provide us with the opportunity to turn organic "waste" and into a valuable renewable energy resource in a sustainable manner.<a>(96. BDTC)</a> </p>
                        <b>Q. What has been your experience in the niche sector of biogas? Are biogas plants making headway in the states of Rajasthan, Gujarat and Diu-Daman? </b>
                        <p class="mb-20"><b>A.</b> There is an ample potential of biogas plant installation in these states. Gujarat has already covered more than 70% of its estimated potential whereas Rajasthan and Diu-Daman have still a lot of scope to work upon. The biogas technology can play an important role in rural and semi urban sectors for fuel and fertilizer production apart from sanitation and environmental benefits in urban areas. Waste recycling through biomethanation is a promising option for electricity generation. The climatic conditions are also favourable in all these three states for biogas generation. <a>(97. BDTC)</a></p>
                    </div>
                </div>
            </div>
            <div id="technology" class="tab-pane fade">
                <div class="box box-primary">
                    <div class="box-body faq-box">
                        <b>Q. How many plants can I hold?</b>
                        <p class="mb-20"><b>A.</b> I have a running plant and I need one more plant. Our plant was built 8 to10 years ago but it is not functional, can we get another one? We are two brothers living in the same house right now; house and land are in the name of father. Can we build individual plant on our account/name? Due to lack of real answers to the above questions at the departmental level, many plants are not able to be built. What should we do? It is true that once a beneficiary runs a plant, and later on he feels shortage of fuel. For this, a suitable decision can be taken by giving the detailed explanation in written by the beneficiary in the construction department with all the information. At present there are no clear guidelines in this matter in the central government rules.<a>(MNRE)</a> </p>
                        <b>Q. How long does it take to build a biogas plant?</b>
                        <p class="mb-20"><b>A.</b> Small size biogas plants (1 - 10 m<sup>3</sup>) can be constructed and made functional within a duration of 1-2 months. Large capacity (>25 m<sup>3</sup>) may take about 4-6 months to have a functional biogas plant.<a>(MNRE)</a></p>
                        <b>Q. Are there any chances of transmitting pathogens through using the digested slurry from the biogas plant?</b>
                        <p class="mb-20"><b>A.</b> No. As the biogas plant functions at a temperature of 35 – 40 °C under anaerobic condition, any bacteria or virus present in it will be denatured. Also, this causes the weed seeds to be dormant and prohibit the weed growth when applied to the agricultural field. <a>(MNRE)</a></p>
                        <b>Q. Which plants are more successful in terms of utility? </b>
                        <p class="mb-20"><b>A.</b> In view of utility Deenbandhu and KVIC models are more successful plant. <a>(MNRE)</a></p>
                        <b>Q. Deenbandhu plant gives good gas initially, why should it decrease after some time?</b>
                        <p class="mb-20"><b>A.</b> This problem is mainly due to three reasons in Deenbandhu plant first due to change in quantity and quality of Daily feeding, the pipe joints open it selves and on repeatedly closing the gate valve. <a>(MNRE)</a></p>
                        <b>Q. What are the standard designs of biogas plant available? </b>
                        <p class="mb-20"><b>A.</b> Under the family size biogas plant 1, 2, 3, 4, and 6 CUM plants are considered as standard design. <a>(18. BDTC)</a></p>
                        <b>Q. What are the materials required for construction of a biogas plant? </b>
                        <p class="mb-20"><b>A.</b> Bricks, cement, sand, concrete, is required for construction of a biogas plant. PVC or asbestos pipe is used for inlet and outlet as required. For KVIC biogas plant, additional GI sheets are needed for fabrication of gas holder. (Table 2 & Table 5.) Recently, HDPI material based readymade biogas products are available in market. They could be used for biomethanation. <a>(34. BDTC)</a></p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/21.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="60%" height="60%">
                        <div class="clearfix"></div>
                        <b>Q. Why the gas holder portion is painted with di-epoxy paint?</b>
                        <p class="mb-20"><b>A.</b> The conventional method of repairing is either with applying oil paint or tar coat over plastering. The inner surface has not proved to be result oriented as a film of oil paint is too thin and tar does not have good bonding with any cemented surface and even new plaster also develops cracks and peels off due to change in compressive strength between the old and new plaster. Epoxy paint has two part- a Hardener and Resin. Both are mixed in equal ratio for application. After application, it becomes a thin harder surface that enables gas to escapes from cracks. <a>(37. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/22.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <b>Q. Is it possible to construct a biogas plant on hilly region?</b>
                        <p class="mb-20"><b>A.</b> In the hilly region, there are two major issues- </p>
                        <ul>
                            <li> Loss in temperature from digester during night which downs the rate of gas production. </li>
                            <li> Digging of pit for deep construction due to stones. In such situation, KVIC biogas plants are not suitable for optimum production. Fixed dome biogas plants could be functioning well. Deenbandhu biogas plant would be economically sounds better due to its less excavation work. <a>(38. BDTC)</a></li>
                        </ul>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/23.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <b>Q. How much area is required for installing a biogas plant?</b>
                        <p class="mb-20"><b>A.</b> It depends on the size of the biogas plant. Generally, 2 cum biogas plant requires 15 feet x 15 feet plane surface. The site must be open to receive sun radiation for most part of the day that keep the plant warm. <a>(21. BDTC)</a></p>
                        <b>Q. Are there any criteria for selection of best site for installation of biogas plant? </b>
                        <p class="mb-20"><b>A.</b> Following points should be considered while selecting a site for installation of biogas plant- </p>
                        <ul>
                            <li> It should be close to the kitchen to minimise cost on gas pipeline </li>
                            <li> It should be near to cattle shed to minimise the distance for carrying cattle dung. </li>
                            <li> There should be enough space for storage of digested slurry or construction of compost pit. </li>
                            <li> It should be 10-15 meters away from any drinking water well to prevent contamination of water. </li>
                            <li> The area should be free from roots of tree which are likely to creep into the digester and cause damage. </li>
                            <li> It should be open to receive the sun radiation for most part of the day to keep the digester warm. </li>
                            <li> It should be on an elevated area so that plant does not get submerged during normal rains.<a>(22. BDTC)</a> </li>
                        </ul>
                        <b>Q. What are the components of a biogas plant?</b>
                        <p class="mb-20"><b>A.</b>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/24.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                         A biogas plant consists of the following parts- </p>
                        <ul>
                            <li> Mixing tank and inlet </li>
                            <li> Digester </li>
                            <li> Gas holder or gas storage dome </li>
                            <li> Outlet and compost pit </li>
                            <li> Gas main outlet valve, pipeline, gas stove <a>(23. BDTC)</a></li>
                        </ul>
                        <b>Q. Such a big target cannot be completed without the help of those entrepreneurs who are working in rural areas like NGOs, Gram panchayat etc. Is there any financial benefit to NGO for taking such projects? </b>
                        <p class="mb-20"><b>A.</b> The Turn-key job fee is linked with five years warranty for trouble-free functioning of biogas plants set up on Turn-Key Work basis. Turn-key job fee of Rs. 1500/- is payable for biogas plants involving part construction work either for digester or dome. Only MNRE approved family type biogas plants are eligible for this assistance. This is subject to the condition that the Turn-Key Worker would visit the plant at least twice in a year during the warranty period. The fee is paid to turn key worker as per MNRE norms. <a>(43. BDTC)</a></p>
                        <b>Q. As mentioned, a biogas plant can be constructed by a skilled and trained labour. How we can contact with those trained biogas masons?</b>
                        <p class="mb-20"><b>A.</b> Every year MNRE approved training centres organise trainings to create a cadre of masons and technicians skilled in the construction and maintenance of approved models of biogas plant. List of those training centre is given in Annexure-1 with contact details. It is better for beneficiary to contact once at these training centres before planning for construction of biogas plant. <a>(44. BDTC)</a></p>
                        <b>Q. Why aren't we doing more with biogas? What are the barriers to increasing biogas production and use?</b>
                        <p class="mb-20"><b>A.</b> Biogas is being collected and used to generate electricity or steam at many landfills, wastewater plants. However, many opportunities for biogas production are yet to be implemented. Until recently, the low cost of fossil fuels has hindered implementation of biogas production. There is a limited awareness of the potential and advantages of biogas production by citizens, government officials, and in the business sector that has limited interest in biogas production. More education, demonstration and investment in biogas technology would help overcome these barriers.<a>(45. BDTC)</a> </p>
                        <b>Q. Is there any role of earth condition in laying foundation for biogas plant?</b>
                        <p class="mb-20"><b>A.</b> Of course, if the earth is sandy, hard brick ballast is laid by an ordinary procedure using cement, sand and brick ballast (1:4:8) or cement, sand and gravel mortar (1:2:4) without reinforced. If during wet earth is observed, there is a possibility of water seepage through the ordinary laid foundation in rainy season. Therefore, under these circumstances, a 75 mm thick layer of dry brick ballast (without cement) is spread and is well compacted. Above this a 150 mm thick layer of cement, sand and brick ballast at a ratio of 1:4:8 is laid. In this layer a net of steel rods of 15 mm diameter (tied by binding wire) bound at a distance of 10.5cm each is also used as reinforcement.<a>(49. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/25.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="50%" height="50%">
                        <div class="clearfix"></div>
                        <b>Q. What would be the mortar ratio maintain at different constructional stages?</b>
                        <p class="mb-20"><b>A.</b> The mortar ratio to be maintained at different constructional stages of a biogas plant is mentioned as under <a>(50. BDTC)</a></p>
                        <div class="col-md-8">
                        <table class="table table-bordered mb-20">
                            <thead>
                                <th>Constructional stage</th>
                                <th>Material</th>
                                <th>Ratio</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Laying foundation (in dry earth condition)</td>
                                <td>Cement : Sand : Brick Ballast Cement : Sand : Gravel</td>
                                <td>1:4:8 <br><br> 1:2:4</td>
                            </tr>
                            <tr>
                                <td>Laying foundation (in dry earth condition)</td>
                                <td>Cement : Sand : Brick Ballast And reinforcement</td>
                                <td>1:4:8 <br><br> 1:5 mm diameter</td>
                            </tr>
                            <tr>
                                <td>Construction of digester (wall thickness 115mm)<br><br> (wall thickness 230mm)</td>
                                <td>Cement : Sand</td>
                                <td>1:4 <br><br> 1:6</td>
                            </tr>
                            <tr>
                                <td>Construction of dome</td>
                                <td>Cement : fine sand : Coarse sand</td>
                                <td>1:1:2</td>
                            </tr>
                            <tr>
                                <td>Outer Plaster I (12 mm thick)</td>
                                <td>Cement : fine sand : Coarse sand</td>
                                <td>1:2:3</td>
                            </tr>
                            <tr>
                                <td>Outer Plaster II (12 mm thick)</td>
                                <td>Cement : fine sand : Coarse sand</td>
                                <td>1:1:2</td>
                            </tr>
                            <tr>
                                <td>Inner Plaster at dome ceiling (12 mm thick)</td>
                                <td>Cement : fine sand</td>
                                <td>1:2</td>
                            </tr>
                            <tr>
                                <td>Inner plaster at digester (12mm thick)</td>
                                <td>Cement : fine sand : Coarse sand</td>
                                <td>1:1:3</td>
                            </tr>
                            <tr>
                                <td>Coating</td>
                                <td>Cement : water</td>
                                <td>1:2</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="clearfix"></div>
                        <b>Q. In many cases, partition wall collapsed in KVIC biogas plant. Why?</b>
                        <p class="mb-20"><b>A.</b> Partition wall is constructed to divide the circular well into two equal halves in biogas plant of 4m<sup>3</sup> or above. It controls the flow of slurry. It is recommended to feed slurry on both side of partition wall with equal quantity at the time of initial feeding. It maintains equal pressure on partition wall. Pressure difference causes collapse situation.<a>(51. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/26.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <b>Q.Fabrication of steel drum for gas holder in floating drum biogas plant at beneficiary level is a tough task. The holder may be fabricated with improper dimensions. Which is the easiest point to purchase it as readymade?</b>
                        <p class="mb-20"><b>A.</b> The gas holder and guide frame can be purchased from a nearby approved workshop of a State Agro Industries Corporation, a fabricator recognised by a State Govemment/KVIC Board or State Nodal Agency.<a>(52. BDTC)</a> </p>
                        <div class="clearfix"></div>
                        <img src="{{url('public/images/faqs/27.jpg')}}" class="img-rounded mb-5" alt="Cinque Terre" width="30%" height="30%">
                        <div class="clearfix"></div>
                        <b>Q. What are the components in gas distribution pipeline? </b>
                        <p class="mb-20"><b>A.</b> The gas distribution pipeline includes the gas vent pipe, gate valve, hose pipe, moisture trap, pipe, bends, joints, stop cock, pressure tube clips etc.<a>(53. BDTC)</a> </p>
                        <b>Q. What would be the appropriate size of pipe in gas distribution line? </b>
                        <p class="mb-20"><b>A.</b> The size of the pipe depends upon the distance between the plant and the kitchen. The greater the distance, the larger should be the diameter of the pipe. With the pressure of approximately 8 cm water column, one cubic meter biogas can be transported in one hour in a 12mm pipe over about 20m, in a 19mm pipe over about 150m and in a 25mm pipe over 500m.<a>(54. BDTC)</a> </p>
                        <div class="col-md-6">
                            <table class="table table-bordered mb-20">
                                <thead>
                                    <th width=10%>Diameter of pipe (mm)</th>
                                    <th width=10%>Distance between plant to kitchen (meter)</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>12</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <td>25</td>
                                    <td>100</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <b>Q. Where should fire arrester be placed? </b>
                        <p class="mb-20"><b>A.</b> Fire arrester is placed just after the main gas valve near the digester or just before the gas stove. It is safer to have one at both places. <a>(56. BDTC)</a></p>
                        <b>Q. What would be the size of the fire arrester with respect to pipe line?</b>
                        <p class="mb-20"><b>A.</b> For a 12mm main gas pipe use a 19mm arrester and for a 25mm pipe use a 32mm arrester. <a>(57. BDTC)</a></p>
                    </div>
                </div>
            </div>
            <div id="mnresupport" class="tab-pane fade">
                <div class="box box-primary">
                    <div class="box-body faq-box">
                        <b>Q. How beneficial is the family type biogas plant per family, financially?</b>
                        <p class="mb-20"><b>A.</b> Usually, it takes one hour for a person to pour cow dung solution daily in a family biogas plant. Whereas in turn, the maximum usage of gas is 0.31 cubic meter per person per day with a LPG equivalent value of Rs.7.50 for 0.2 kg and the equivalent value of NPK in biogas fertilizer from dung is Rs. 5.00, thus approximately Rs 12.5 is daily savings per person per day.</p>
                        <b>Q. Do any of the authorized banks provide financial assistance in the form of a compulsory loan for the construction of the plant or does the construction agency help in getting loan from the bank?</b>
                        <p class="mb-20"><b>A.</b> No, at present most of the banks do not provide separate loan for construction of family biogas plant. There are no clear guidelines by the authorized banks. The manufacturing agency also does not cooperate in getting plant construction loan from the bank, although this decision is within the jurisdiction of the bank. Therefore, the farmer can get the plant constructed by taking a general loan or agricultural loan.</p>
                        <b>Q. Currently how does the central government calculate the subsidy on the plant?</b>
                        <p class="mb-20"><b>A.</b> According to the central government guidelines, a plant with a capacity of 2 cubic meters is required to meet the fuel requirement of a 5 member’s family. Considering this the basis actual value is calculated to provide 45% to 50 % for providing subsidy. At the meantime, many state governments are also provides different assistance.</p>
                        <b>Q. Whether beneficiary should get grant according to capacity on construction of family type biogas plant?</b>
                        <p class="mb-20"><b>A.</b> Capacity wise decision on biogas plant subsidy can be taken jointly by the central and the state government.</p>
                        <b>Q. Does the central government revise the grant amount every year with the value of inflation rate?</b>
                        <p class="mb-20"><b>A.</b> No, yet the central government amends the grant amount in 5 years or more.</p>
                        <b>Q. What is the reason, why biogas plant is relatively less built or not and what measures should be taken for this?</b>
                        <p class="mb-20"><b>A.</b> Although it depends on the wishes of the farmer, mainly the farmer needs lump sum financial assistance at the time of construction while the grant money also gets after the construction because the middle and small farmers are not so financially capable while Other means of the fuel become available at monthly expense, compared to being able to construct it, at a reasonable cost.</p>
                        <b>Q. After knowing the benefits of biogas plant at the village level, due to less publicity, why most of the farmers are still not fully aware of its construction and operation?</b>
                        <p class="mb-20"><b>A.</b> Through the limited resources of the agency working in the state government, this program has been going on for the past many years, so basically the farmers have some information. Currently many self-employed workers are also working in this area. Information through new telecommunications also can be obtained.</p>
                        <b>Q. What is the expected action if many plants remain non-functional due to construction shortcomings or lack of proper selection of beneficiaries?</b>
                        <p class="mb-20"><b>A.</b> It depends on the construction agency and the beneficiary, but according to the central government's plan, the plant is built by the construction agency in a guarantee of 5 years, in which case the beneficiary should get the construction faults with the help of the construction agency.</p>
                        <b>Q. Does after conducting a survey at the village or panchayat level by the central government before gives an annual target to the village for producing biogas plant?</b>
                        <p class="mb-20"><b>A.</b> No, their targets are set based on the demand of construction agencies working in the districts of the state.</p>
                        <b>Q. Can the project be run smoothly by the construction agency through the sarpanch and secretary of the gram panchayat?</b>
                        <p class="mb-20"><b>A.</b> There is scope for this because the number of employees in the construction agency is limited, so it can be run well through the sarpanch and village secretary of the gram panchayat as they are regular in contact with villagers.</p>
                        <b>Q. Are there any technical institutions of the State Government in the states that continuously monitor the work of the working agencies?</b>
                        <p class="mb-20"><b>A.</b> No, most of the state government has no technical institution.</p>
                        <b>Q. Does the agencies working in states are under central government?</b>
                        <p class="mb-20"><b>A.</b> No, it is appointed by the state government.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function(){
        if(screen.width > 1366) $('.faq-box').css('max-height', '500px');
    })
</script>
@endsection