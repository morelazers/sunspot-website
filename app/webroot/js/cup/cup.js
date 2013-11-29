function cup(){

var containe;
var scene;
var camera; 
var renderer; 
var controls;
var keyboard = new THREEx.KeyboardState();
var zTranslation = 0;
var shape;
var water;
var dial;
var array=[];
var group = new THREE.Object3D();//create an empty container

init();
animate();
               
	function init() 
	{
		// SCENE
		scene = new THREE.Scene();
		
		// CAMERA
		var SCREEN_WIDTH = 510;
		var SCREEN_HEIGHT = 510;
		var VIEW_ANGLE = 45;
		var ASPECT = SCREEN_WIDTH / SCREEN_HEIGHT;
		var NEAR = 0.1;
		var FAR = 20000;
		camera = new THREE.PerspectiveCamera( VIEW_ANGLE, ASPECT, NEAR, FAR);
		scene.add(camera);
		camera.position.set(0,200,400);
		camera.lookAt(scene.position); 
		
		// RENDERER
		if (Detector.webgl)
				renderer = new THREE.WebGLRenderer({antialias:true});
		else
				renderer = new THREE.CanvasRenderer(); 
		renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);
		container = document.getElementById('cup');
		container.appendChild(renderer.domElement);
		
		//EVENTS
		THREEx.WindowResize(renderer, camera);
		
		//CONTROLS
		controls = new THREE.OrbitControls(camera, renderer.domElement);
		
		//LIGHT
		var light = new THREE.PointLight(0xffffff);
		light.position.set(0,250,0);
		scene.add(light);
		
		//FOG
		var skyBoxGeometry = new THREE.CubeGeometry(10000,10000,10000);
		var skyBoxMaterial = new THREE.MeshBasicMaterial({color:0x9999ff, side:THREE.backSide});
		var skyBox = new THREE.Mesh(skyBoxGeometry,skyBoxMaterial);
		
		//SCENE.ADD(FOG);
		scene.fog = new THREE.FogExp2(0x9999ff, 0.00025);
		
		//CUP MATERIAL
		var darkMaterial = new THREE.MeshBasicMaterial({color:0x1C1C1C, side:THREE.DoubleSide, transparent:true, opacity: 0.3});
		var wireframeMaterial = new THREE.MeshBasicMaterial({color:0x000000, wireframe:true, side:THREE.DoubleSide, transparent:true, opacity:0.3}); 
		var multiMaterial = [darkMaterial, wireframeMaterial];
		
		//WATER MATERIAL
		var blueMaterial = new THREE.MeshBasicMaterial({color:0x0033CC, side:THREE.DoubleSide});
		var waterWireframeMaterial = new THREE.MeshBasicMaterial({color:0x000000, wireframe:false}); 
		var waterMaterial = [blueMaterial, waterWireframeMaterial];
		
		//DIAL MATERIAL
		var redMaterial = new THREE.MeshBasicMaterial({color:0xFF0000, side:THREE.DoubleSide});
		var dialWireframeMaterial = new THREE.MeshBasicMaterial({color:0x000000, wireframe:false}); 
		var dialMaterial = [redMaterial, dialWireframeMaterial];
		
		//CUP SHAPE
		var shapeGeometry = new THREE.CylinderGeometry(80,40,200,50,50,true);
		shape = THREE.SceneUtils.createMultiMaterialObject( shapeGeometry,multiMaterial );// radiusAtTop, radiusAtBottom, height, segmentsAroundRadius, segmentsAlongHeight, ends capped
		shape.position.set(0,-25,0);//Set X, Y and Z positions
		//scene.add(shape);
		group.add(shape);//add a mesh with geometry to it
		
		/*array[0] = new THREE.Mesh(shape);
		THREE.GeometryUtils.merge(mainGeom, array[0]);*/
		
		//WATER SHAPE
		var waterGeometry = new THREE.CylinderGeometry(65,35,150,25,25);
		water = THREE.SceneUtils.createMultiMaterialObject(waterGeometry,waterMaterial);// radiusAtTop, radiusAtBottom, height, segmentsAroundRadius, segmentsAlongHeight, ends capped
		water.position.set(0,-50,0);//Set , Y and Z positions
		//scene.add(water);
		group.add(water);
		
		/*array[1] = new THREE.Mesh(water);
		THREE.GeometryUtils.merge(mainGeom, array[1]);*/
		
		//DIAL SHAPE
		var dialGeometry = new THREE.CylinderGeometry(0,5,20,10,10,false);
		dial = THREE.SceneUtils.createMultiMaterialObject( dialGeometry,dialMaterial );// radiusAtTop, radiusAtBottom, height, segmentsAroundRadius, segmentsAlongHeight, ends capped
		dial.position.set(0,160,0);//Set X, Y and Z positions
		//scene.add(dial);
		group.add(dial);
		
		scene.add(group);//when done, add the group to the scene
		
		/*array[2] = new THREE.Mesh(dial);
		THREE.GeometryUtils.merge(mainGeom, array[2]);
		scene.add(mainGeom);*/
		
		/*//CUP OUTLINE
		var outlineMaterial1 = new THREE.MeshBasicMaterial( { color: 0x000000, side: THREE.BackSide } );
        var outlineMesh1 = new THREE.Mesh(shapeGeometry , outlineMaterial1 );
        outlineMesh1.position = shape.position;
        outlineMesh1.scale.multiplyScalar(1.05);
        scene.add( outlineMesh1 );*/
	}

	function animate(){
		requestAnimationFrame(animate);
		render();                
		update();
	}

	function update(){
		if(keyboard.pressed("a")){ 
            zTranslation += 0.01;
        }else if(keyboard.pressed("d")){
			zTranslation -= 0.01;
		}
		controls.update();
	}

	function render() 
	{
			shape.rotation.z = zTranslation;
			water.rotation.z = zTranslation;
			dial.rotation.z = zTranslation;
			renderer.render( scene, camera );
	}
}