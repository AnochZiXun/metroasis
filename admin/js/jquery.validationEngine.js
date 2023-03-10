��/ *  
   *   I n l i n e   F o r m   V a l i d a t i o n   E n g i n e   2 . 6 . 2 ,   j Q u e r y   p l u g i n  
   *  
   *   C o p y r i g h t ( c )   2 0 1 0 ,   C e d r i c   D u g a s  
   *   h t t p : / / w w w . p o s i t i o n - a b s o l u t e . c o m  
   *  
   *   2 . 0   R e w r i t e   b y   O l i v i e r   R e f a l o  
   *   h t t p : / / w w w . c r i o n i c s . c o m  
   *  
   *   F o r m   v a l i d a t i o n   e n g i n e   a l l o w i n g   c u s t o m   r e g e x   r u l e s   t o   b e   a d d e d .  
   *   L i c e n s e d   u n d e r   t h e   M I T   L i c e n s e  
   * /  
   ( f u n c t i o n ( $ )   {  
  
 	 " u s e   s t r i c t " ;  
  
 	 v a r   m e t h o d s   =   {  
  
 	 	 / * *  
 	 	 *   K i n d   o f   t h e   c o n s t r u c t o r ,   c a l l e d   b e f o r e   a n y   a c t i o n  
 	 	 *   @ p a r a m   { M a p }   u s e r   o p t i o n s  
 	 	 * /  
 	 	 i n i t :   f u n c t i o n ( o p t i o n s )   {  
 	 	 	 v a r   f o r m   =   t h i s ;  
 	 	 	 i f   ( ! f o r m . d a t a ( ' j q v ' )   | |   f o r m . d a t a ( ' j q v ' )   = =   n u l l   )   {  
 	 	 	 	 o p t i o n s   =   m e t h o d s . _ s a v e O p t i o n s ( f o r m ,   o p t i o n s ) ;  
 	 	 	 	 / /   b i n d   a l l   f o r m E r r o r   e l e m e n t s   t o   c l o s e   o n   c l i c k  
 	 	 	 	 $ ( d o c u m e n t ) . o n ( " c l i c k " ,   " . f o r m E r r o r " ,   f u n c t i o n ( )   {  
 	 	 	 	 	 $ ( t h i s ) . f a d e O u t ( 1 5 0 ,   f u n c t i o n ( )   {  
 	 	 	 	 	 	 / /   r e m o v e   p r o m p t   o n c e   i n v i s i b l e  
 	 	 	 	 	 	 $ ( t h i s ) . p a r e n t ( ' . f o r m E r r o r O u t e r ' ) . r e m o v e ( ) ;  
 	 	 	 	 	 	 $ ( t h i s ) . r e m o v e ( ) ;  
 	 	 	 	 	 } ) ;  
 	 	 	 	 } ) ;  
 	 	 	 }  
 	 	 	 r e t u r n   t h i s ;  
 	 	   } ,  
 	 	 / * *  
 	 	 *   A t t a c h s   j Q u e r y . v a l i d a t i o n E n g i n e   t o   f o r m . s u b m i t   a n d   f i e l d . b l u r   e v e n t s  
 	 	 *   T a k e s   a n   o p t i o n a l   p a r a m s :   a   l i s t   o f   o p t i o n s  
 	 	 *   i e .   j Q u e r y ( " # f o r m I D 1 " ) . v a l i d a t i o n E n g i n e ( ' a t t a c h ' ,   { p r o m p t P o s i t i o n   :   " c e n t e r R i g h t " } ) ;  
 	 	 * /  
 	 	 a t t a c h :   f u n c t i o n ( u s e r O p t i o n s )   {  
  
 	 	 	 v a r   f o r m   =   t h i s ;  
 	 	 	 v a r   o p t i o n s ;  
  
 	 	 	 i f ( u s e r O p t i o n s )  
 	 	 	 	 o p t i o n s   =   m e t h o d s . _ s a v e O p t i o n s ( f o r m ,   u s e r O p t i o n s ) ;  
 	 	 	 e l s e  
 	 	 	 	 o p t i o n s   =   f o r m . d a t a ( ' j q v ' ) ;  
  
 	 	 	 o p t i o n s . v a l i d a t e A t t r i b u t e   =   ( f o r m . f i n d ( " [ d a t a - v a l i d a t i o n - e n g i n e * = v a l i d a t e ] " ) . l e n g t h )   ?   " d a t a - v a l i d a t i o n - e n g i n e "   :   " c l a s s " ;  
 	 	 	 i f   ( o p t i o n s . b i n d e d )   {  
  
 	 	 	 	 / /   d e l e g a t e   f i e l d s  
 	 	 	 	 f o r m . o n ( o p t i o n s . v a l i d a t i o n E v e n t T r i g g e r ,   " [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = v a l i d a t e ] : n o t ( [ t y p e = c h e c k b o x ] ) : n o t ( [ t y p e = r a d i o ] ) : n o t ( . d a t e p i c k e r ) " ,   m e t h o d s . _ o n F i e l d E v e n t ) ;  
 	 	 	 	 f o r m . o n ( " c l i c k " ,   " [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = v a l i d a t e ] [ t y p e = c h e c k b o x ] , [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = v a l i d a t e ] [ t y p e = r a d i o ] " ,   m e t h o d s . _ o n F i e l d E v e n t ) ;  
 	 	 	 	 f o r m . o n ( o p t i o n s . v a l i d a t i o n E v e n t T r i g g e r , " [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = v a l i d a t e ] [ c l a s s * = d a t e p i c k e r ] " ,   { " d e l a y " :   3 0 0 } ,   m e t h o d s . _ o n F i e l d E v e n t ) ;  
 	 	 	 }  
 	 	 	 i f   ( o p t i o n s . a u t o P o s i t i o n U p d a t e )   {  
 	 	 	 	 $ ( w i n d o w ) . b i n d ( " r e s i z e " ,   {  
 	 	 	 	 	 " n o A n i m a t i o n " :   t r u e ,  
 	 	 	 	 	 " f o r m E l e m " :   f o r m  
 	 	 	 	 } ,   m e t h o d s . u p d a t e P r o m p t s P o s i t i o n ) ;  
 	 	 	 }  
 	 	 	 f o r m . o n ( " c l i c k " , " a [ d a t a - v a l i d a t i o n - e n g i n e - s k i p ] ,   a [ c l a s s * = ' v a l i d a t e - s k i p ' ] ,   b u t t o n [ d a t a - v a l i d a t i o n - e n g i n e - s k i p ] ,   b u t t o n [ c l a s s * = ' v a l i d a t e - s k i p ' ] ,   i n p u t [ d a t a - v a l i d a t i o n - e n g i n e - s k i p ] ,   i n p u t [ c l a s s * = ' v a l i d a t e - s k i p ' ] " ,   m e t h o d s . _ s u b m i t B u t t o n C l i c k ) ;  
 	 	 	 f o r m . r e m o v e D a t a ( ' j q v _ s u b m i t B u t t o n ' ) ;  
  
 	 	 	 / /   b i n d   f o r m . s u b m i t  
 	 	 	 f o r m . o n ( " s u b m i t " ,   m e t h o d s . _ o n S u b m i t E v e n t ) ;  
 	 	 	 r e t u r n   t h i s ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   U n r e g i s t e r s   a n y   b i n d i n g s   t h a t   m a y   p o i n t   t o   j Q u e r y . v a l i d a i t o n E n g i n e  
 	 	 * /  
 	 	 d e t a c h :   f u n c t i o n ( )   {  
  
 	 	 	 v a r   f o r m   =   t h i s ;  
 	 	 	 v a r   o p t i o n s   =   f o r m . d a t a ( ' j q v ' ) ;  
  
 	 	 	 / /   u n b i n d   f i e l d s  
 	 	 	 f o r m . f i n d ( " [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = v a l i d a t e ] " ) . n o t ( " [ t y p e = c h e c k b o x ] " ) . o f f ( o p t i o n s . v a l i d a t i o n E v e n t T r i g g e r ,   m e t h o d s . _ o n F i e l d E v e n t ) ;  
 	 	 	 f o r m . f i n d ( " [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = v a l i d a t e ] [ t y p e = c h e c k b o x ] , [ c l a s s * = v a l i d a t e ] [ t y p e = r a d i o ] " ) . o f f ( " c l i c k " ,   m e t h o d s . _ o n F i e l d E v e n t ) ;  
  
 	 	 	 / /   u n b i n d   f o r m . s u b m i t  
 	 	 	 f o r m . o f f ( " s u b m i t " ,   m e t h o d s . _ o n S u b m i t E v e n t ) ;  
 	 	 	 f o r m . r e m o v e D a t a ( ' j q v ' ) ;  
                          
 	 	 	 f o r m . o f f ( " c l i c k " ,   " a [ d a t a - v a l i d a t i o n - e n g i n e - s k i p ] ,   a [ c l a s s * = ' v a l i d a t e - s k i p ' ] ,   b u t t o n [ d a t a - v a l i d a t i o n - e n g i n e - s k i p ] ,   b u t t o n [ c l a s s * = ' v a l i d a t e - s k i p ' ] ,   i n p u t [ d a t a - v a l i d a t i o n - e n g i n e - s k i p ] ,   i n p u t [ c l a s s * = ' v a l i d a t e - s k i p ' ] " ,   m e t h o d s . _ s u b m i t B u t t o n C l i c k ) ;  
 	 	 	 f o r m . r e m o v e D a t a ( ' j q v _ s u b m i t B u t t o n ' ) ;  
  
 	 	 	 i f   ( o p t i o n s . a u t o P o s i t i o n U p d a t e )  
 	 	 	 	 $ ( w i n d o w ) . o f f ( " r e s i z e " ,   m e t h o d s . u p d a t e P r o m p t s P o s i t i o n ) ;  
  
 	 	 	 r e t u r n   t h i s ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   V a l i d a t e s   e i t h e r   a   f o r m   o r   a   l i s t   o f   f i e l d s ,   s h o w s   p r o m p t s   a c c o r d i n g l y .  
 	 	 *   N o t e :   T h e r e   i s   n o   a j a x   f o r m   v a l i d a t i o n   w i t h   t h i s   m e t h o d ,   o n l y   f i e l d   a j a x   v a l i d a t i o n   a r e   e v a l u a t e d  
 	 	 *  
 	 	 *   @ r e t u r n   t r u e   i f   t h e   f o r m   v a l i d a t e s ,   f a l s e   i f   i t   f a i l s  
 	 	 * /  
 	 	 v a l i d a t e :   f u n c t i o n ( )   {  
 	 	 	 v a r   e l e m e n t   =   $ ( t h i s ) ;  
 	 	 	 v a r   v a l i d   =   n u l l ;  
  
 	 	 	 i f   ( e l e m e n t . i s ( " f o r m " )   | |   e l e m e n t . h a s C l a s s ( " v a l i d a t i o n E n g i n e C o n t a i n e r " ) )   {  
 	 	 	 	 i f   ( e l e m e n t . h a s C l a s s ( ' v a l i d a t i n g ' ) )   {  
 	 	 	 	 	 / /   f o r m   i s   a l r e a d y   v a l i d a t i n g .  
 	 	 	 	 	 / /   S h o u l d   a b o r t   o l d   v a l i d a t i o n   a n d   s t a r t   n e w   o n e .   I   d o n ' t   k n o w   h o w   t o   i m p l e m e n t   i t .  
 	 	 	 	 	 r e t u r n   f a l s e ;  
 	 	 	 	 }   e l s e   { 	 	 	 	  
 	 	 	 	 	 e l e m e n t . a d d C l a s s ( ' v a l i d a t i n g ' ) ;  
 	 	 	 	 	 v a r   o p t i o n s   =   e l e m e n t . d a t a ( ' j q v ' ) ;  
 	 	 	 	 	 v a r   v a l i d   =   m e t h o d s . _ v a l i d a t e F i e l d s ( t h i s ) ;  
  
 	 	 	 	 	 / /   I f   t h e   f o r m   d o e s n ' t   v a l i d a t e ,   c l e a r   t h e   ' v a l i d a t i n g '   c l a s s   b e f o r e   t h e   u s e r   h a s   a   c h a n c e   t o   s u b m i t   a g a i n  
 	 	 	 	 	 s e t T i m e o u t ( f u n c t i o n ( ) {  
 	 	 	 	 	 	 e l e m e n t . r e m o v e C l a s s ( ' v a l i d a t i n g ' ) ;  
 	 	 	 	 	 } ,   1 0 0 ) ;  
 	 	 	 	 	 i f   ( v a l i d   & &   o p t i o n s . o n S u c c e s s )   {  
 	 	 	 	 	 	 o p t i o n s . o n S u c c e s s ( ) ;  
 	 	 	 	 	 }   e l s e   i f   ( ! v a l i d   & &   o p t i o n s . o n F a i l u r e )   {  
 	 	 	 	 	 	 o p t i o n s . o n F a i l u r e ( ) ;  
 	 	 	 	 	 }  
 	 	 	 	 }  
 	 	 	 }   e l s e   i f   ( e l e m e n t . i s ( ' f o r m ' )   | |   e l e m e n t . h a s C l a s s ( ' v a l i d a t i o n E n g i n e C o n t a i n e r ' ) )   {  
 	 	 	 	 e l e m e n t . r e m o v e C l a s s ( ' v a l i d a t i n g ' ) ;  
 	 	 	 }   e l s e   {  
 	 	 	 	 / /   f i e l d   v a l i d a t i o n  
 	 	 	 	 v a r   f o r m   =   e l e m e n t . c l o s e s t ( ' f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r ' ) ,  
 	 	 	 	 	 o p t i o n s   =   ( f o r m . d a t a ( ' j q v ' ) )   ?   f o r m . d a t a ( ' j q v ' )   :   $ . v a l i d a t i o n E n g i n e . d e f a u l t s ,  
 	 	 	 	 	 v a l i d   =   m e t h o d s . _ v a l i d a t e F i e l d ( e l e m e n t ,   o p t i o n s ) ;  
  
 	 	 	 	 i f   ( v a l i d   & &   o p t i o n s . o n F i e l d S u c c e s s )  
 	 	 	 	 	 o p t i o n s . o n F i e l d S u c c e s s ( ) ;  
 	 	 	 	 e l s e   i f   ( o p t i o n s . o n F i e l d F a i l u r e   & &   o p t i o n s . I n v a l i d F i e l d s . l e n g t h   >   0 )   {  
 	 	 	 	 	 o p t i o n s . o n F i e l d F a i l u r e ( ) ;  
 	 	 	 	 }  
 	 	 	 }  
 	 	 	 i f ( o p t i o n s . o n V a l i d a t i o n C o m p l e t e )   {  
 	 	 	 	 / /   ! !   e n s u r e s   t h a t   a n   u n d e f i n e d   r e t u r n   i s   i n t e r p r e t e d   a s   r e t u r n   f a l s e   b u t   a l l o w s   a   o n V a l i d a t i o n C o m p l e t e ( )   t o   p o s s i b l y   r e t u r n   t r u e   a n d   h a v e   f o r m   c o n t i n u e   p r o c e s s i n g  
 	 	 	 	 r e t u r n   ! ! o p t i o n s . o n V a l i d a t i o n C o m p l e t e ( f o r m ,   v a l i d ) ;  
 	 	 	 }  
 	 	 	 r e t u r n   v a l i d ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *     R e d r a w   p r o m p t s   p o s i t i o n ,   u s e f u l   w h e n   y o u   c h a n g e   t h e   D O M   s t a t e   w h e n   v a l i d a t i n g  
 	 	 * /  
 	 	 u p d a t e P r o m p t s P o s i t i o n :   f u n c t i o n ( e v e n t )   {  
  
 	 	 	 i f   ( e v e n t   & &   t h i s   = =   w i n d o w )   {  
 	 	 	 	 v a r   f o r m   =   e v e n t . d a t a . f o r m E l e m ;  
 	 	 	 	 v a r   n o A n i m a t i o n   =   e v e n t . d a t a . n o A n i m a t i o n ;  
 	 	 	 }  
 	 	 	 e l s e  
 	 	 	 	 v a r   f o r m   =   $ ( t h i s . c l o s e s t ( ' f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r ' ) ) ;  
  
 	 	 	 v a r   o p t i o n s   =   f o r m . d a t a ( ' j q v ' ) ;  
 	 	 	 / /   N o   o p t i o n ,   t a k e   d e f a u l t   o n e  
 	 	 	 f o r m . f i n d ( ' [ ' + o p t i o n s . v a l i d a t e A t t r i b u t e + ' * = v a l i d a t e ] ' ) . n o t ( " : d i s a b l e d " ) . e a c h ( f u n c t i o n ( ) {  
 	 	 	 	 v a r   f i e l d   =   $ ( t h i s ) ;  
 	 	 	 	 i f   ( o p t i o n s . p r e t t y S e l e c t   & &   f i e l d . i s ( " : h i d d e n " ) )  
 	 	 	 	     f i e l d   =   f o r m . f i n d ( " # "   +   o p t i o n s . u s e P r e f i x   +   f i e l d . a t t r ( ' i d ' )   +   o p t i o n s . u s e S u f f i x ) ;  
 	 	 	 	 v a r   p r o m p t   =   m e t h o d s . _ g e t P r o m p t ( f i e l d ) ;  
 	 	 	 	 v a r   p r o m p t T e x t   =   $ ( p r o m p t ) . f i n d ( " . f o r m E r r o r C o n t e n t " ) . h t m l ( ) ;  
  
 	 	 	 	 i f ( p r o m p t )  
 	 	 	 	 	 m e t h o d s . _ u p d a t e P r o m p t ( f i e l d ,   $ ( p r o m p t ) ,   p r o m p t T e x t ,   u n d e f i n e d ,   f a l s e ,   o p t i o n s ,   n o A n i m a t i o n ) ;  
 	 	 	 } ) ;  
 	 	 	 r e t u r n   t h i s ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   D i s p l a y s   a   p r o m p t   o n   a   e l e m e n t .  
 	 	 *   N o t e   t h a t   t h e   e l e m e n t   n e e d s   a n   i d !  
 	 	 *  
 	 	 *   @ p a r a m   { S t r i n g }   p r o m p t T e x t   h t m l   t e x t   t o   d i s p l a y   t y p e  
 	 	 *   @ p a r a m   { S t r i n g }   t y p e   t h e   t y p e   o f   b u b b l e :   ' p a s s '   ( g r e e n ) ,   ' l o a d '   ( b l a c k )   a n y t h i n g   e l s e   ( r e d )  
 	 	 *   @ p a r a m   { S t r i n g }   p o s s i b l e   v a l u e s   t o p L e f t ,   t o p R i g h t ,   b o t t o m L e f t ,   c e n t e r R i g h t ,   b o t t o m R i g h t  
 	 	 * /  
 	 	 s h o w P r o m p t :   f u n c t i o n ( p r o m p t T e x t ,   t y p e ,   p r o m p t P o s i t i o n ,   s h o w A r r o w )   {  
 	 	 	 v a r   f o r m   =   t h i s . c l o s e s t ( ' f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r ' ) ;  
 	 	 	 v a r   o p t i o n s   =   f o r m . d a t a ( ' j q v ' ) ;  
 	 	 	 / /   N o   o p t i o n ,   t a k e   d e f a u l t   o n e  
 	 	 	 i f ( ! o p t i o n s )  
 	 	 	 	 o p t i o n s   =   m e t h o d s . _ s a v e O p t i o n s ( t h i s ,   o p t i o n s ) ;  
 	 	 	 i f ( p r o m p t P o s i t i o n )  
 	 	 	 	 o p t i o n s . p r o m p t P o s i t i o n = p r o m p t P o s i t i o n ;  
 	 	 	 o p t i o n s . s h o w A r r o w   =   s h o w A r r o w = = t r u e ;  
  
 	 	 	 m e t h o d s . _ s h o w P r o m p t ( t h i s ,   p r o m p t T e x t ,   t y p e ,   f a l s e ,   o p t i o n s ) ;  
 	 	 	 r e t u r n   t h i s ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C l o s e s   f o r m   e r r o r   p r o m p t s ,   C A N   b e   i n v i d u a l  
 	 	 * /  
 	 	 h i d e :   f u n c t i o n ( )   {  
 	 	 	   v a r   f o r m   =   $ ( t h i s ) . c l o s e s t ( ' f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r ' ) ;  
 	 	 	   v a r   o p t i o n s   =   f o r m . d a t a ( ' j q v ' ) ;  
 	 	 	   v a r   f a d e D u r a t i o n   =   ( o p t i o n s   & &   o p t i o n s . f a d e D u r a t i o n )   ?   o p t i o n s . f a d e D u r a t i o n   :   0 . 3 ;  
 	 	 	   v a r   c l o s i n g t a g ;  
 	 	 	    
 	 	 	   i f ( $ ( t h i s ) . i s ( " f o r m " )   | |   $ ( t h i s ) . h a s C l a s s ( " v a l i d a t i o n E n g i n e C o n t a i n e r " ) )   {  
 	 	 	 	   c l o s i n g t a g   =   " p a r e n t F o r m " + m e t h o d s . _ g e t C l a s s N a m e ( $ ( t h i s ) . a t t r ( " i d " ) ) ;  
 	 	 	   }   e l s e   {  
 	 	 	 	   c l o s i n g t a g   =   m e t h o d s . _ g e t C l a s s N a m e ( $ ( t h i s ) . a t t r ( " i d " ) )   + " f o r m E r r o r " ;  
 	 	 	   }  
 	 	 	   $ ( ' . ' + c l o s i n g t a g ) . f a d e T o ( f a d e D u r a t i o n ,   0 . 3 ,   f u n c t i o n ( )   {  
 	 	 	 	   $ ( t h i s ) . p a r e n t ( ' . f o r m E r r o r O u t e r ' ) . r e m o v e ( ) ;  
 	 	 	 	   $ ( t h i s ) . r e m o v e ( ) ;  
 	 	 	   } ) ;  
 	 	 	   r e t u r n   t h i s ;  
 	 	   } ,  
 	 	   / * *  
 	 	   *   C l o s e s   a l l   e r r o r   p r o m p t s   o n   t h e   p a g e  
 	 	   * /  
 	 	   h i d e A l l :   f u n c t i o n ( )   {  
  
 	 	 	   v a r   f o r m   =   t h i s ;  
 	 	 	   v a r   o p t i o n s   =   f o r m . d a t a ( ' j q v ' ) ;  
 	 	 	   v a r   d u r a t i o n   =   o p t i o n s   ?   o p t i o n s . f a d e D u r a t i o n : 3 0 0 ;  
 	 	 	   $ ( ' . f o r m E r r o r ' ) . f a d e T o ( d u r a t i o n ,   3 0 0 ,   f u n c t i o n ( )   {  
 	 	 	 	   $ ( t h i s ) . p a r e n t ( ' . f o r m E r r o r O u t e r ' ) . r e m o v e ( ) ;  
 	 	 	 	   $ ( t h i s ) . r e m o v e ( ) ;  
 	 	 	   } ) ;  
 	 	 	   r e t u r n   t h i s ;  
 	 	   } ,  
 	 	 / * *  
 	 	 *   T y p i c a l l y   c a l l e d   w h e n   u s e r   e x i s t s   a   f i e l d   u s i n g   t a b   o r   a   m o u s e   c l i c k ,   t r i g g e r s   a   f i e l d  
 	 	 *   v a l i d a t i o n  
 	 	 * /  
 	 	 _ o n F i e l d E v e n t :   f u n c t i o n ( e v e n t )   {  
 	 	 	 v a r   f i e l d   =   $ ( t h i s ) ;  
 	 	 	 v a r   f o r m   =   f i e l d . c l o s e s t ( ' f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r ' ) ;  
 	 	 	 v a r   o p t i o n s   =   f o r m . d a t a ( ' j q v ' ) ;  
 	 	 	 o p t i o n s . e v e n t T r i g g e r   =   " f i e l d " ;  
 	 	 	 / /   v a l i d a t e   t h e   c u r r e n t   f i e l d  
 	 	 	 w i n d o w . s e t T i m e o u t ( f u n c t i o n ( )   {  
 	 	 	 	 m e t h o d s . _ v a l i d a t e F i e l d ( f i e l d ,   o p t i o n s ) ;  
 	 	 	 	 i f   ( o p t i o n s . I n v a l i d F i e l d s . l e n g t h   = =   0   & &   o p t i o n s . o n F i e l d S u c c e s s )   {  
 	 	 	 	 	 o p t i o n s . o n F i e l d S u c c e s s ( ) ;  
 	 	 	 	 }   e l s e   i f   ( o p t i o n s . I n v a l i d F i e l d s . l e n g t h   >   0   & &   o p t i o n s . o n F i e l d F a i l u r e )   {  
 	 	 	 	 	 o p t i o n s . o n F i e l d F a i l u r e ( ) ;  
 	 	 	 	 }  
 	 	 	 } ,   ( e v e n t . d a t a )   ?   e v e n t . d a t a . d e l a y   :   0 ) ;  
  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C a l l e d   w h e n   t h e   f o r m   i s   s u b m i t e d ,   s h o w s   p r o m p t s   a c c o r d i n g l y  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }  
 	 	 *                         f o r m  
 	 	 *   @ r e t u r n   f a l s e   i f   f o r m   s u b m i s s i o n   n e e d s   t o   b e   c a n c e l l e d  
 	 	 * /  
 	 	 _ o n S u b m i t E v e n t :   f u n c t i o n ( )   {  
 	 	 	 v a r   f o r m   =   $ ( t h i s ) ;  
 	 	 	 v a r   o p t i o n s   =   f o r m . d a t a ( ' j q v ' ) ;  
 	 	 	  
 	 	 	 / / c h e c k   i f   i t   i s   t r i g g e r   f r o m   s k i p p e d   b u t t o n  
 	 	 	 i f   ( f o r m . d a t a ( " j q v _ s u b m i t B u t t o n " ) ) {  
 	 	 	 	 v a r   s u b m i t B u t t o n   =   $ ( " # "   +   f o r m . d a t a ( " j q v _ s u b m i t B u t t o n " ) ) ;  
 	 	 	 	 i f   ( s u b m i t B u t t o n ) {  
 	 	 	 	 	 i f   ( s u b m i t B u t t o n . l e n g t h   >   0 ) {  
 	 	 	 	 	 	 i f   ( s u b m i t B u t t o n . h a s C l a s s ( " v a l i d a t e - s k i p " )   | |   s u b m i t B u t t o n . a t t r ( " d a t a - v a l i d a t i o n - e n g i n e - s k i p " )   = =   " t r u e " )  
 	 	 	 	 	 	 	 r e t u r n   t r u e ;  
 	 	 	 	 	 }  
 	 	 	 	 }  
 	 	 	 }  
  
 	 	 	 o p t i o n s . e v e n t T r i g g e r   =   " s u b m i t " ;  
  
 	 	 	 / /   v a l i d a t e   e a c h   f i e l d    
 	 	 	 / /   ( -   s k i p   f i e l d   a j a x   v a l i d a t i o n ,   n o t   n e c e s s a r y   I F   w e   w i l l   p e r f o r m   a n   a j a x   f o r m   v a l i d a t i o n )  
 	 	 	 v a r   r = m e t h o d s . _ v a l i d a t e F i e l d s ( f o r m ) ;  
  
 	 	 	 i f   ( r   & &   o p t i o n s . a j a x F o r m V a l i d a t i o n )   {  
 	 	 	 	 m e t h o d s . _ v a l i d a t e F o r m W i t h A j a x ( f o r m ,   o p t i o n s ) ;  
 	 	 	 	 / /   c a n c e l   f o r m   a u t o - s u b m i s s i o n   -   p r o c e s s   w i t h   a s y n c   c a l l   o n A j a x F o r m C o m p l e t e  
 	 	 	 	 r e t u r n   f a l s e ;  
 	 	 	 }  
  
 	 	 	 i f ( o p t i o n s . o n V a l i d a t i o n C o m p l e t e )   {  
 	 	 	 	 / /   ! !   e n s u r e s   t h a t   a n   u n d e f i n e d   r e t u r n   i s   i n t e r p r e t e d   a s   r e t u r n   f a l s e   b u t   a l l o w s   a   o n V a l i d a t i o n C o m p l e t e ( )   t o   p o s s i b l y   r e t u r n   t r u e   a n d   h a v e   f o r m   c o n t i n u e   p r o c e s s i n g  
 	 	 	 	 r e t u r n   ! ! o p t i o n s . o n V a l i d a t i o n C o m p l e t e ( f o r m ,   r ) ;  
 	 	 	 }  
 	 	 	 r e t u r n   r ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   R e t u r n   t r u e   i f   t h e   a j a x   f i e l d   v a l i d a t i o n s   p a s s e d   s o   f a r  
 	 	 *   @ p a r a m   { O b j e c t }   o p t i o n s  
 	 	 *   @ r e t u r n   t r u e ,   i s   a l l   a j a x   v a l i d a t i o n   p a s s e d   s o   f a r   ( r e m e m b e r   a j a x   i s   a s y n c )  
 	 	 * /  
 	 	 _ c h e c k A j a x S t a t u s :   f u n c t i o n ( o p t i o n s )   {  
 	 	 	 v a r   s t a t u s   =   t r u e ;  
 	 	 	 $ . e a c h ( o p t i o n s . a j a x V a l i d C a c h e ,   f u n c t i o n ( k e y ,   v a l u e )   {  
 	 	 	 	 i f   ( ! v a l u e )   {  
 	 	 	 	 	 s t a t u s   =   f a l s e ;  
 	 	 	 	 	 / /   b r e a k   t h e   e a c h  
 	 	 	 	 	 r e t u r n   f a l s e ;  
 	 	 	 	 }  
 	 	 	 } ) ;  
 	 	 	 r e t u r n   s t a t u s ;  
 	 	 } ,  
 	 	  
 	 	 / * *  
 	 	 *   R e t u r n   t r u e   i f   t h e   a j a x   f i e l d   i s   v a l i d a t e d  
 	 	 *   @ p a r a m   { S t r i n g }   f i e l d i d  
 	 	 *   @ p a r a m   { O b j e c t }   o p t i o n s  
 	 	 *   @ r e t u r n   t r u e ,   i f   v a l i d a t i o n   p a s s e d ,   f a l s e   i f   f a l s e   o r   d o e s n ' t   e x i s t  
 	 	 * /  
 	 	 _ c h e c k A j a x F i e l d S t a t u s :   f u n c t i o n ( f i e l d i d ,   o p t i o n s )   {  
 	 	 	 r e t u r n   o p t i o n s . a j a x V a l i d C a c h e [ f i e l d i d ]   = =   t r u e ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   V a l i d a t e s   f o r m   f i e l d s ,   s h o w s   p r o m p t s   a c c o r d i n g l y  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }  
 	 	 *                         f o r m  
 	 	 *   @ p a r a m   { s k i p A j a x F i e l d V a l i d a t i o n }  
 	 	 *                         b o o l e a n   -   w h e n   s e t   t o   t r u e ,   a j a x   f i e l d   v a l i d a t i o n   i s   s k i p p e d ,   t y p i c a l l y   u s e d   w h e n   t h e   s u b m i t   b u t t o n   i s   c l i c k e d  
 	 	 *  
 	 	 *   @ r e t u r n   t r u e   i f   f o r m   i s   v a l i d ,   f a l s e   i f   n o t ,   u n d e f i n e d   i f   a j a x   f o r m   v a l i d a t i o n   i s   d o n e  
 	 	 * /  
 	 	 _ v a l i d a t e F i e l d s :   f u n c t i o n ( f o r m )   {  
 	 	 	 v a r   o p t i o n s   =   f o r m . d a t a ( ' j q v ' ) ;  
  
 	 	 	 / /   t h i s   v a r i a b l e   i s   s e t   t o   t r u e   i f   a n   e r r o r   i s   f o u n d  
 	 	 	 v a r   e r r o r F o u n d   =   f a l s e ;  
  
 	 	 	 / /   T r i g g e r   h o o k ,   s t a r t   v a l i d a t i o n  
 	 	 	 f o r m . t r i g g e r ( " j q v . f o r m . v a l i d a t i n g " ) ;  
 	 	 	 / /   f i r s t ,   e v a l u a t e   s t a t u s   o f   n o n   a j a x   f i e l d s  
 	 	 	 v a r   f i r s t _ e r r = n u l l ;  
 	 	 	 f o r m . f i n d ( ' [ ' + o p t i o n s . v a l i d a t e A t t r i b u t e + ' * = v a l i d a t e ] ' ) . n o t ( " : d i s a b l e d " ) . e a c h (   f u n c t i o n ( )   {  
 	 	 	 	 v a r   f i e l d   =   $ ( t h i s ) ;  
 	 	 	 	 v a r   n a m e s   =   [ ] ;  
 	 	 	 	 i f   ( $ . i n A r r a y ( f i e l d . a t t r ( ' n a m e ' ) ,   n a m e s )   <   0 )   {  
 	 	 	 	 	 e r r o r F o u n d   | =   m e t h o d s . _ v a l i d a t e F i e l d ( f i e l d ,   o p t i o n s ) ;  
 	 	 	 	 	 i f   ( e r r o r F o u n d   & &   f i r s t _ e r r = = n u l l )  
 	 	 	 	 	 	 i f   ( f i e l d . i s ( " : h i d d e n " )   & &   o p t i o n s . p r e t t y S e l e c t )  
 	 	 	 	 	 	 	 f i r s t _ e r r   =   f i e l d   =   f o r m . f i n d ( " # "   +   o p t i o n s . u s e P r e f i x   +   m e t h o d s . _ j q S e l e c t o r ( f i e l d . a t t r ( ' i d ' ) )   +   o p t i o n s . u s e S u f f i x ) ;  
 	 	 	 	 	 	 e l s e   {  
  
 	 	 	 	 	 	 	 / / C h e c k   i f   w e   n e e d   t o   a d j u s t   w h a t   e l e m e n t   t o   s h o w   t h e   p r o m p t   o n  
 	 	 	 	 	 	 	 / / a n d   a n d   s u c h   s c r o l l   t o   i n s t e a d  
 	 	 	 	 	 	 	 i f ( f i e l d . d a t a ( ' j q v - p r o m p t - a t ' )   i n s t a n c e o f   j Q u e r y   ) {  
 	 	 	 	 	 	 	 	 f i e l d   =   f i e l d . d a t a ( ' j q v - p r o m p t - a t ' ) ;  
 	 	 	 	 	 	 	 }   e l s e   i f ( f i e l d . d a t a ( ' j q v - p r o m p t - a t ' ) )   {  
 	 	 	 	 	 	 	 	 f i e l d   =   $ ( f i e l d . d a t a ( ' j q v - p r o m p t - a t ' ) ) ;  
 	 	 	 	 	 	 	 }  
 	 	 	 	 	 	 	 f i r s t _ e r r = f i e l d ;  
 	 	 	 	 	 	 }  
 	 	 	 	 	 i f   ( o p t i o n s . d o N o t S h o w A l l E r r o s O n S u b m i t )  
 	 	 	 	 	 	 r e t u r n   f a l s e ;  
 	 	 	 	 	 n a m e s . p u s h ( f i e l d . a t t r ( ' n a m e ' ) ) ;  
  
 	 	 	 	 	 / / i f   o p t i o n   s e t ,   s t o p   c h e c k i n g   v a l i d a t i o n   r u l e s   a f t e r   o n e   e r r o r   i s   f o u n d  
 	 	 	 	 	 i f ( o p t i o n s . s h o w O n e M e s s a g e   = =   t r u e   & &   e r r o r F o u n d ) {  
 	 	 	 	 	 	 r e t u r n   f a l s e ;  
 	 	 	 	 	 }  
 	 	 	 	 }  
 	 	 	 } ) ;  
  
 	 	 	 / /   s e c o n d ,   c h e c k   t o   s e e   i f   a l l   a j a x   c a l l s   c o m p l e t e d   o k  
 	 	 	 / /   e r r o r F o u n d   | =   ! m e t h o d s . _ c h e c k A j a x S t a t u s ( o p t i o n s ) ;  
  
 	 	 	 / /   t h i r d ,   c h e c k   s t a t u s   a n d   s c r o l l   t h e   c o n t a i n e r   a c c o r d i n g l y  
 	 	 	 f o r m . t r i g g e r ( " j q v . f o r m . r e s u l t " ,   [ e r r o r F o u n d ] ) ;  
  
 	 	 	 i f   ( e r r o r F o u n d )   {  
 	 	 	 	 i f   ( o p t i o n s . s c r o l l )   {  
 	 	 	 	 	 v a r   d e s t i n a t i o n = f i r s t _ e r r . o f f s e t ( ) . t o p ;  
 	 	 	 	 	 v a r   f i x l e f t   =   f i r s t _ e r r . o f f s e t ( ) . l e f t ;  
  
 	 	 	 	 	 / / p r o m p t   p o s i t i o n i n g   a d j u s t m e n t   s u p p o r t .   U s a g e :   p o s i t i o n T y p e : X s h i f t , Y s h i f t   ( f o r   e x . :   b o t t o m L e f t : + 2 0   o r   b o t t o m L e f t : - 2 0 , + 1 0 )  
 	 	 	 	 	 v a r   p o s i t i o n T y p e = o p t i o n s . p r o m p t P o s i t i o n ;  
 	 	 	 	 	 i f   ( t y p e o f ( p o s i t i o n T y p e ) = = ' s t r i n g '   & &   p o s i t i o n T y p e . i n d e x O f ( " : " ) ! = - 1 )  
 	 	 	 	 	 	 p o s i t i o n T y p e = p o s i t i o n T y p e . s u b s t r i n g ( 0 , p o s i t i o n T y p e . i n d e x O f ( " : " ) ) ;  
  
 	 	 	 	 	 i f   ( p o s i t i o n T y p e ! = " b o t t o m R i g h t "   & &   p o s i t i o n T y p e ! = " b o t t o m L e f t " )   {  
 	 	 	 	 	 	 v a r   p r o m p t _ e r r =   m e t h o d s . _ g e t P r o m p t ( f i r s t _ e r r ) ;  
 	 	 	 	 	 	 i f   ( p r o m p t _ e r r )   {  
 	 	 	 	 	 	 	 d e s t i n a t i o n = p r o m p t _ e r r . o f f s e t ( ) . t o p ;  
 	 	 	 	 	 	 }  
 	 	 	 	 	 }  
 	 	 	 	 	  
 	 	 	 	 	 / /   O f f s e t   t h e   a m o u n t   t h e   p a g e   s c r o l l s   b y   a n   a m o u n t   i n   p x   t o   a c c o m o d a t e   f i x e d   e l e m e n t s   a t   t o p   o f   p a g e  
 	 	 	 	 	 i f   ( o p t i o n s . s c r o l l O f f s e t )   {  
 	 	 	 	 	 	 d e s t i n a t i o n   - =   o p t i o n s . s c r o l l O f f s e t ;  
 	 	 	 	 	 }  
  
 	 	 	 	 	 / /   g e t   t h e   p o s i t i o n   o f   t h e   f i r s t   e r r o r ,   t h e r e   s h o u l d   b e   a t   l e a s t   o n e ,   n o   n e e d   t o   c h e c k   t h i s  
 	 	 	 	 	 / / v a r   d e s t i n a t i o n   =   f o r m . f i n d ( " . f o r m E r r o r : n o t ( ' . g r e e n P o p u p ' ) : f i r s t " ) . o f f s e t ( ) . t o p ;  
 	 	 	 	 	 i f   ( o p t i o n s . i s O v e r f l o w n )   {  
 	 	 	 	 	 	 v a r   o v e r f l o w D I V   =   $ ( o p t i o n s . o v e r f l o w n D I V ) ;  
 	 	 	 	 	 	 i f ( ! o v e r f l o w D I V . l e n g t h )   r e t u r n   f a l s e ;  
 	 	 	 	 	 	 v a r   s c r o l l C o n t a i n e r S c r o l l   =   o v e r f l o w D I V . s c r o l l T o p ( ) ;  
 	 	 	 	 	 	 v a r   s c r o l l C o n t a i n e r P o s   =   - p a r s e I n t ( o v e r f l o w D I V . o f f s e t ( ) . t o p ) ;  
  
 	 	 	 	 	 	 d e s t i n a t i o n   + =   s c r o l l C o n t a i n e r S c r o l l   +   s c r o l l C o n t a i n e r P o s   -   5 ;  
 	 	 	 	 	 	 v a r   s c r o l l C o n t a i n e r   =   $ ( o p t i o n s . o v e r f l o w n D I V   +   " : n o t ( : a n i m a t e d ) " ) ;  
  
 	 	 	 	 	 	 s c r o l l C o n t a i n e r . a n i m a t e ( {   s c r o l l T o p :   d e s t i n a t i o n   } ,   1 1 0 0 ,   f u n c t i o n ( ) {  
 	 	 	 	 	 	 	 i f ( o p t i o n s . f o c u s F i r s t F i e l d )   f i r s t _ e r r . f o c u s ( ) ;  
 	 	 	 	 	 	 } ) ;  
  
 	 	 	 	 	 }   e l s e   {  
 	 	 	 	 	 	 $ ( " h t m l ,   b o d y " ) . a n i m a t e ( {  
 	 	 	 	 	 	 	 s c r o l l T o p :   d e s t i n a t i o n  
 	 	 	 	 	 	 } ,   1 1 0 0 ,   f u n c t i o n ( ) {  
 	 	 	 	 	 	 	 i f ( o p t i o n s . f o c u s F i r s t F i e l d )   f i r s t _ e r r . f o c u s ( ) ;  
 	 	 	 	 	 	 } ) ;  
 	 	 	 	 	 	 $ ( " h t m l ,   b o d y " ) . a n i m a t e ( { s c r o l l L e f t :   f i x l e f t } , 1 1 0 0 )  
 	 	 	 	 	 }  
  
 	 	 	 	 }   e l s e   i f ( o p t i o n s . f o c u s F i r s t F i e l d )  
 	 	 	 	 	 f i r s t _ e r r . f o c u s ( ) ;  
 	 	 	 	 r e t u r n   f a l s e ;  
 	 	 	 }  
 	 	 	 r e t u r n   t r u e ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   T h i s   m e t h o d   i s   c a l l e d   t o   p e r f o r m   a n   a j a x   f o r m   v a l i d a t i o n .  
 	 	 *   D u r i n g   t h i s   p r o c e s s   a l l   t h e   ( f i e l d ,   v a l u e )   p a i r s   a r e   s e n t   t o   t h e   s e r v e r   w h i c h   r e t u r n s   a   l i s t   o f   i n v a l i d   f i e l d s   o r   t r u e  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f o r m  
 	 	 *   @ p a r a m   { M a p }   o p t i o n s  
 	 	 * /  
 	 	 _ v a l i d a t e F o r m W i t h A j a x :   f u n c t i o n ( f o r m ,   o p t i o n s )   {  
  
 	 	 	 v a r   d a t a   =   f o r m . s e r i a l i z e ( ) ;  
 	 	 	 	 	 	 	 	 	 v a r   t y p e   =   ( o p t i o n s . a j a x F o r m V a l i d a t i o n M e t h o d )   ?   o p t i o n s . a j a x F o r m V a l i d a t i o n M e t h o d   :   " G E T " ;  
 	 	 	 v a r   u r l   =   ( o p t i o n s . a j a x F o r m V a l i d a t i o n U R L )   ?   o p t i o n s . a j a x F o r m V a l i d a t i o n U R L   :   f o r m . a t t r ( " a c t i o n " ) ;  
 	 	 	 	 	 	 	 	 	 v a r   d a t a T y p e   =   ( o p t i o n s . d a t a T y p e )   ?   o p t i o n s . d a t a T y p e   :   " j s o n " ;  
 	 	 	 $ . a j a x ( {  
 	 	 	 	 t y p e :   t y p e ,  
 	 	 	 	 u r l :   u r l ,  
 	 	 	 	 c a c h e :   f a l s e ,  
 	 	 	 	 d a t a T y p e :   d a t a T y p e ,  
 	 	 	 	 d a t a :   d a t a ,  
 	 	 	 	 f o r m :   f o r m ,  
 	 	 	 	 m e t h o d s :   m e t h o d s ,  
 	 	 	 	 o p t i o n s :   o p t i o n s ,  
 	 	 	 	 b e f o r e S e n d :   f u n c t i o n ( )   {  
 	 	 	 	 	 r e t u r n   o p t i o n s . o n B e f o r e A j a x F o r m V a l i d a t i o n ( f o r m ,   o p t i o n s ) ;  
 	 	 	 	 } ,  
 	 	 	 	 e r r o r :   f u n c t i o n ( d a t a ,   t r a n s p o r t )   {  
 	 	 	 	 	 i f   ( o p t i o n s . o n F a i l u r e )   {  
 	 	 	 	 	 	 o p t i o n s . o n F a i l u r e ( d a t a ,   t r a n s p o r t ) ;  
 	 	 	 	 	 }   e l s e   {  
 	 	 	 	 	 	 m e t h o d s . _ a j a x E r r o r ( d a t a ,   t r a n s p o r t ) ;  
 	 	 	 	 	 }  
 	 	 	 	 } ,  
 	 	 	 	 s u c c e s s :   f u n c t i o n ( j s o n )   {  
 	 	 	 	 	 i f   ( ( d a t a T y p e   = =   " j s o n " )   & &   ( j s o n   ! = =   t r u e ) )   {  
 	 	 	 	 	 	 / /   g e t t i n g   t o   t h i s   c a s e   d o e s n ' t   n e c e s s a r y   m e a n s   t h a t   t h e   f o r m   i s   i n v a l i d  
 	 	 	 	 	 	 / /   t h e   s e r v e r   m a y   r e t u r n   g r e e n   o r   c l o s i n g   p r o m p t   a c t i o n s  
 	 	 	 	 	 	 / /   t h i s   f l a g   h e l p s   f i g u r i n g   i t   o u t  
 	 	 	 	 	 	 v a r   e r r o r I n F o r m = f a l s e ;  
 	 	 	 	 	 	 f o r   ( v a r   i   =   0 ;   i   <   j s o n . l e n g t h ;   i + + )   {  
 	 	 	 	 	 	 	 v a r   v a l u e   =   j s o n [ i ] ;  
  
 	 	 	 	 	 	 	 v a r   e r r o r F i e l d I d   =   v a l u e [ 0 ] ;  
 	 	 	 	 	 	 	 v a r   e r r o r F i e l d   =   $ ( $ ( " # "   +   e r r o r F i e l d I d ) [ 0 ] ) ;  
  
 	 	 	 	 	 	 	 / /   m a k e   s u r e   w e   f o u n d   t h e   e l e m e n t  
 	 	 	 	 	 	 	 i f   ( e r r o r F i e l d . l e n g t h   = =   1 )   {  
  
 	 	 	 	 	 	 	 	 / /   p r o m p t T e x t   o r   s e l e c t o r  
 	 	 	 	 	 	 	 	 v a r   m s g   =   v a l u e [ 2 ] ;  
 	 	 	 	 	 	 	 	 / /   i f   t h e   f i e l d   i s   v a l i d  
 	 	 	 	 	 	 	 	 i f   ( v a l u e [ 1 ]   = =   t r u e )   {  
  
 	 	 	 	 	 	 	 	 	 i f   ( m s g   = =   " "     | |   ! m s g ) {  
 	 	 	 	 	 	 	 	 	 	 / /   i f   f o r   s o m e   r e a s o n ,   s t a t u s = = t r u e   a n d   e r r o r = " " ,   j u s t   c l o s e   t h e   p r o m p t  
 	 	 	 	 	 	 	 	 	 	 m e t h o d s . _ c l o s e P r o m p t ( e r r o r F i e l d ) ;  
 	 	 	 	 	 	 	 	 	 }   e l s e   {  
 	 	 	 	 	 	 	 	 	 	 / /   t h e   f i e l d   i s   v a l i d ,   b u t   w e   a r e   d i s p l a y i n g   a   g r e e n   p r o m p t  
 	 	 	 	 	 	 	 	 	 	 i f   ( o p t i o n s . a l l r u l e s [ m s g ] )   {  
 	 	 	 	 	 	 	 	 	 	 	 v a r   t x t   =   o p t i o n s . a l l r u l e s [ m s g ] . a l e r t T e x t O k ;  
 	 	 	 	 	 	 	 	 	 	 	 i f   ( t x t )  
 	 	 	 	 	 	 	 	 	 	 	 	 m s g   =   t x t ;  
 	 	 	 	 	 	 	 	 	 	 }  
 	 	 	 	 	 	 	 	 	 	 i f   ( o p t i o n s . s h o w P r o m p t s )   m e t h o d s . _ s h o w P r o m p t ( e r r o r F i e l d ,   m s g ,   " p a s s " ,   f a l s e ,   o p t i o n s ,   t r u e ) ;  
 	 	 	 	 	 	 	 	 	 }  
 	 	 	 	 	 	 	 	 }   e l s e   {  
 	 	 	 	 	 	 	 	 	 / /   t h e   f i e l d   i s   i n v a l i d ,   s h o w   t h e   r e d   e r r o r   p r o m p t  
 	 	 	 	 	 	 	 	 	 e r r o r I n F o r m | = t r u e ;  
 	 	 	 	 	 	 	 	 	 i f   ( o p t i o n s . a l l r u l e s [ m s g ] )   {  
 	 	 	 	 	 	 	 	 	 	 v a r   t x t   =   o p t i o n s . a l l r u l e s [ m s g ] . a l e r t T e x t ;  
 	 	 	 	 	 	 	 	 	 	 i f   ( t x t )  
 	 	 	 	 	 	 	 	 	 	 	 m s g   =   t x t ;  
 	 	 	 	 	 	 	 	 	 }  
 	 	 	 	 	 	 	 	 	 i f ( o p t i o n s . s h o w P r o m p t s )   m e t h o d s . _ s h o w P r o m p t ( e r r o r F i e l d ,   m s g ,   " " ,   f a l s e ,   o p t i o n s ,   t r u e ) ;  
 	 	 	 	 	 	 	 	 }  
 	 	 	 	 	 	 	 }  
 	 	 	 	 	 	 }  
 	 	 	 	 	 	 o p t i o n s . o n A j a x F o r m C o m p l e t e ( ! e r r o r I n F o r m ,   f o r m ,   j s o n ,   o p t i o n s ) ;  
 	 	 	 	 	 }   e l s e  
 	 	 	 	 	 	 o p t i o n s . o n A j a x F o r m C o m p l e t e ( t r u e ,   f o r m ,   j s o n ,   o p t i o n s ) ;  
  
 	 	 	 	 }  
 	 	 	 } ) ;  
  
 	 	 } ,  
 	 	 / * *  
 	 	 *   V a l i d a t e s   f i e l d ,   s h o w s   p r o m p t s   a c c o r d i n g l y  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }  
 	 	 *                         f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }  
 	 	 *                         f i e l d ' s   v a l i d a t i o n   r u l e s  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   f a l s e   i f   f i e l d   i s   v a l i d   ( I t   i s   i n v e r s e d   f o r   * f i e l d s * ,   i t   r e t u r n   f a l s e   o n   v a l i d a t e   a n d   t r u e   o n   e r r o r s . )  
 	 	 * /  
 	 	 _ v a l i d a t e F i e l d :   f u n c t i o n ( f i e l d ,   o p t i o n s ,   s k i p A j a x V a l i d a t i o n )   {  
 	 	 	 i f   ( ! f i e l d . a t t r ( " i d " ) )   {  
 	 	 	 	 f i e l d . a t t r ( " i d " ,   " f o r m - v a l i d a t i o n - f i e l d - "   +   $ . v a l i d a t i o n E n g i n e . f i e l d I d C o u n t e r ) ;  
 	 	 	 	 + + $ . v a l i d a t i o n E n g i n e . f i e l d I d C o u n t e r ;  
 	 	 	 }  
  
                       i f   ( ! o p t i o n s . v a l i d a t e N o n V i s i b l e F i e l d s   & &   ( f i e l d . i s ( " : h i d d e n " )   & &   ! o p t i o n s . p r e t t y S e l e c t   | |   f i e l d . p a r e n t ( ) . i s ( " : h i d d e n " ) ) )  
 	 	 	 	 r e t u r n   f a l s e ;  
  
 	 	 	 v a r   r u l e s P a r s i n g   =   f i e l d . a t t r ( o p t i o n s . v a l i d a t e A t t r i b u t e ) ;  
 	 	 	 v a r   g e t R u l e s   =   / v a l i d a t e \ [ ( . * ) \ ] / . e x e c ( r u l e s P a r s i n g ) ;  
  
 	 	 	 i f   ( ! g e t R u l e s )  
 	 	 	 	 r e t u r n   f a l s e ;  
 	 	 	 v a r   s t r   =   g e t R u l e s [ 1 ] ;  
 	 	 	 v a r   r u l e s   =   s t r . s p l i t ( / \ [ | , | \ ] / ) ;  
  
 	 	 	 / /   t r u e   i f   w e   r a n   t h e   a j a x   v a l i d a t i o n ,   t e l l s   t h e   l o g i c   t o   s t o p   m e s s i n g   w i t h   p r o m p t s  
 	 	 	 v a r   i s A j a x V a l i d a t o r   =   f a l s e ;  
 	 	 	 v a r   f i e l d N a m e   =   f i e l d . a t t r ( " n a m e " ) ;  
 	 	 	 v a r   p r o m p t T e x t   =   " " ;  
 	 	 	 v a r   p r o m p t T y p e   =   " " ;  
 	 	 	 v a r   r e q u i r e d   =   f a l s e ;  
 	 	 	 v a r   l i m i t E r r o r s   =   f a l s e ;  
 	 	 	 o p t i o n s . i s E r r o r   =   f a l s e ;  
 	 	 	 o p t i o n s . s h o w A r r o w   =   t r u e ;  
 	 	 	  
 	 	 	 / /   I f   t h e   p r o g r a m m e r   w a n t s   t o   l i m i t   t h e   a m o u n t   o f   e r r o r   m e s s a g e s   p e r   f i e l d ,  
 	 	 	 i f   ( o p t i o n s . m a x E r r o r s P e r F i e l d   >   0 )   {  
 	 	 	 	 l i m i t E r r o r s   =   t r u e ;  
 	 	 	 }  
  
 	 	 	 v a r   f o r m   =   $ ( f i e l d . c l o s e s t ( " f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r " ) ) ;  
 	 	 	 / /   F i x   f o r   a d d i n g   s p a c e s   i n   t h e   r u l e s  
 	 	 	 f o r   ( v a r   i   =   0 ;   i   <   r u l e s . l e n g t h ;   i + + )   {  
 	 	 	 	 r u l e s [ i ]   =   r u l e s [ i ] . r e p l a c e ( "   " ,   " " ) ;  
 	 	 	 	 / /   R e m o v e   a n y   p a r s i n g   e r r o r s  
 	 	 	 	 i f   ( r u l e s [ i ]   = = =   ' ' )   {  
 	 	 	 	 	 d e l e t e   r u l e s [ i ] ;  
 	 	 	 	 }  
 	 	 	 }  
  
 	 	 	 f o r   ( v a r   i   =   0 ,   f i e l d _ e r r o r s   =   0 ;   i   <   r u l e s . l e n g t h ;   i + + )   {  
 	 	 	 	  
 	 	 	 	 / /   I f   w e   a r e   l i m i t i n g   e r r o r s ,   a n d   h a v e   h i t   t h e   m a x ,   b r e a k  
 	 	 	 	 i f   ( l i m i t E r r o r s   & &   f i e l d _ e r r o r s   > =   o p t i o n s . m a x E r r o r s P e r F i e l d )   {  
 	 	 	 	 	 / /   I f   w e   h a v e n ' t   h i t   a   r e q u i r e d   y e t ,   c h e c k   t o   s e e   i f   t h e r e   i s   o n e   i n   t h e   v a l i d a t i o n   r u l e s   f o r   t h i s  
 	 	 	 	 	 / /   f i e l d   a n d   t h a t   i t ' s   i n d e x   i s   g r e a t e r   o r   e q u a l   t o   o u r   c u r r e n t   i n d e x  
 	 	 	 	 	 i f   ( ! r e q u i r e d )   {  
 	 	 	 	 	 	 v a r   h a v e _ r e q u i r e d   =   $ . i n A r r a y ( ' r e q u i r e d ' ,   r u l e s ) ;  
 	 	 	 	 	 	 r e q u i r e d   =   ( h a v e _ r e q u i r e d   ! =   - 1   & &     h a v e _ r e q u i r e d   > =   i ) ;  
 	 	 	 	 	 }  
 	 	 	 	 	 b r e a k ;  
 	 	 	 	 }  
 	 	 	 	  
 	 	 	 	  
 	 	 	 	 v a r   e r r o r M s g   =   u n d e f i n e d ;  
 	 	 	 	 s w i t c h   ( r u l e s [ i ] )   {  
  
 	 	 	 	 	 c a s e   " r e q u i r e d " :  
 	 	 	 	 	 	 r e q u i r e d   =   t r u e ;  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ r e q u i r e d ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " c u s t o m " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ c u s t o m ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " g r o u p R e q u i r e d " :  
 	 	 	 	 	 	 / /   C h e c k   i s   i t s   t h e   f i r s t   o f   g r o u p ,   i f   n o t ,   r e l o a d   v a l i d a t i o n   w i t h   f i r s t   f i e l d  
 	 	 	 	 	 	 / /   A N D   c o n t i n u e   n o r m a l   v a l i d a t i o n   o n   p r e s e n t   f i e l d  
 	 	 	 	 	 	 v a r   c l a s s G r o u p   =   " [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = "   + r u l e s [ i   +   1 ]   + " ] " ;  
 	 	 	 	 	 	 v a r   f i r s t O f G r o u p   =   f o r m . f i n d ( c l a s s G r o u p ) . e q ( 0 ) ;  
 	 	 	 	 	 	 i f ( f i r s t O f G r o u p [ 0 ]   ! =   f i e l d [ 0 ] ) {  
  
 	 	 	 	 	 	 	 m e t h o d s . _ v a l i d a t e F i e l d ( f i r s t O f G r o u p ,   o p t i o n s ,   s k i p A j a x V a l i d a t i o n ) ;    
 	 	 	 	 	 	 	 o p t i o n s . s h o w A r r o w   =   t r u e ;  
  
 	 	 	 	 	 	 }  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ g r o u p R e q u i r e d ) ;  
 	 	 	 	 	 	 i f ( e r r o r M s g )     r e q u i r e d   =   t r u e ;  
 	 	 	 	 	 	 o p t i o n s . s h o w A r r o w   =   f a l s e ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " a j a x " :  
 	 	 	 	 	 	 / /   A J A X   d e f a u l t s   t o   r e t u r n i n g   i t ' s   l o a d i n g   m e s s a g e  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ a j a x ( f i e l d ,   r u l e s ,   i ,   o p t i o n s ) ;  
 	 	 	 	 	 	 i f   ( e r r o r M s g )   {  
 	 	 	 	 	 	 	 p r o m p t T y p e   =   " l o a d " ;  
 	 	 	 	 	 	 }  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " m i n S i z e " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ m i n S i z e ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " m a x S i z e " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ m a x S i z e ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " m i n " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ m i n ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " m a x " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ m a x ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " p a s t " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d , r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ p a s t ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " f u t u r e " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d , r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ f u t u r e ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " d a t e R a n g e " :  
 	 	 	 	 	 	 v a r   c l a s s G r o u p   =   " [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = "   +   r u l e s [ i   +   1 ]   +   " ] " ;  
 	 	 	 	 	 	 o p t i o n s . f i r s t O f G r o u p   =   f o r m . f i n d ( c l a s s G r o u p ) . e q ( 0 ) ;  
 	 	 	 	 	 	 o p t i o n s . s e c o n d O f G r o u p   =   f o r m . f i n d ( c l a s s G r o u p ) . e q ( 1 ) ;  
  
 	 	 	 	 	 	 / / i f   o n e   e n t r y   o u t   o f   t h e   p a i r   h a s   v a l u e   t h e n   p r o c e e d   t o   r u n   t h r o u g h   v a l i d a t i o n  
 	 	 	 	 	 	 i f   ( o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e   | |   o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e )   {  
 	 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d , r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ d a t e R a n g e ) ;  
 	 	 	 	 	 	 }  
 	 	 	 	 	 	 i f   ( e r r o r M s g )   r e q u i r e d   =   t r u e ;  
 	 	 	 	 	 	 o p t i o n s . s h o w A r r o w   =   f a l s e ;  
 	 	 	 	 	 	 b r e a k ;  
  
 	 	 	 	 	 c a s e   " d a t e T i m e R a n g e " :  
 	 	 	 	 	 	 v a r   c l a s s G r o u p   =   " [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = "   +   r u l e s [ i   +   1 ]   +   " ] " ;  
 	 	 	 	 	 	 o p t i o n s . f i r s t O f G r o u p   =   f o r m . f i n d ( c l a s s G r o u p ) . e q ( 0 ) ;  
 	 	 	 	 	 	 o p t i o n s . s e c o n d O f G r o u p   =   f o r m . f i n d ( c l a s s G r o u p ) . e q ( 1 ) ;  
  
 	 	 	 	 	 	 / / i f   o n e   e n t r y   o u t   o f   t h e   p a i r   h a s   v a l u e   t h e n   p r o c e e d   t o   r u n   t h r o u g h   v a l i d a t i o n  
 	 	 	 	 	 	 i f   ( o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e   | |   o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e )   {  
 	 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d , r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ d a t e T i m e R a n g e ) ;  
 	 	 	 	 	 	 }  
 	 	 	 	 	 	 i f   ( e r r o r M s g )   r e q u i r e d   =   t r u e ;  
 	 	 	 	 	 	 o p t i o n s . s h o w A r r o w   =   f a l s e ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " m a x C h e c k b o x " :  
 	 	 	 	 	 	 f i e l d   =   $ ( f o r m . f i n d ( " i n p u t [ n a m e = ' "   +   f i e l d N a m e   +   " ' ] " ) ) ;  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ m a x C h e c k b o x ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " m i n C h e c k b o x " :  
 	 	 	 	 	 	 f i e l d   =   $ ( f o r m . f i n d ( " i n p u t [ n a m e = ' "   +   f i e l d N a m e   +   " ' ] " ) ) ;  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ m i n C h e c k b o x ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " e q u a l s " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ e q u a l s ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " f u n c C a l l " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ f u n c C a l l ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " c r e d i t C a r d " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ c r e d i t C a r d ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " c o n d R e q u i r e d " :  
 	 	 	 	 	 	 e r r o r M s g   =   m e t h o d s . _ g e t E r r o r M e s s a g e ( f o r m ,   f i e l d ,   r u l e s [ i ] ,   r u l e s ,   i ,   o p t i o n s ,   m e t h o d s . _ c o n d R e q u i r e d ) ;  
 	 	 	 	 	 	 i f   ( e r r o r M s g   ! = =   u n d e f i n e d )   {  
 	 	 	 	 	 	 	 r e q u i r e d   =   t r u e ;  
 	 	 	 	 	 	 }  
 	 	 	 	 	 	 b r e a k ;  
  
 	 	 	 	 	 d e f a u l t :  
 	 	 	 	 }  
 	 	 	 	  
 	 	 	 	 v a r   e n d _ v a l i d a t i o n   =   f a l s e ;  
 	 	 	 	  
 	 	 	 	 / /   I f   w e   w e r e   p a s s e d   b a c k   a n   m e s s a g e   o b j e c t ,   c h e c k   w h a t   t h e   s t a t u s   w a s   t o   d e t e r m i n e   w h a t   t o   d o  
 	 	 	 	 i f   ( t y p e o f   e r r o r M s g   = =   " o b j e c t " )   {  
 	 	 	 	 	 s w i t c h   ( e r r o r M s g . s t a t u s )   {  
 	 	 	 	 	 	 c a s e   " _ b r e a k " :  
 	 	 	 	 	 	 	 e n d _ v a l i d a t i o n   =   t r u e ;  
 	 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 	 / /   I f   w e   h a v e   a n   e r r o r   m e s s a g e ,   s e t   e r r o r M s g   t o   t h e   e r r o r   m e s s a g e  
 	 	 	 	 	 	 c a s e   " _ e r r o r " :  
 	 	 	 	 	 	 	 e r r o r M s g   =   e r r o r M s g . m e s s a g e ;  
 	 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 	 / /   I f   w e   w a n t   t o   t h r o w   a n   e r r o r ,   b u t   n o t   s h o w   a   p r o m p t ,   r e t u r n   e a r l y   w i t h   t r u e  
 	 	 	 	 	 	 c a s e   " _ e r r o r _ n o _ p r o m p t " :  
 	 	 	 	 	 	 	 r e t u r n   t r u e ;  
 	 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 	 / /   A n y t h i n g   e l s e   w e   c o n t i n u e   o n  
 	 	 	 	 	 	 d e f a u l t :  
 	 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 }  
 	 	 	 	 }  
 	 	 	 	  
 	 	 	 	 / /   I f   i t   h a s   b e e n   s p e c i f i e d   t h a t   v a l i d a t i o n   s h o u l d   e n d   n o w ,   b r e a k  
 	 	 	 	 i f   ( e n d _ v a l i d a t i o n )   {  
 	 	 	 	 	 b r e a k ;  
 	 	 	 	 }  
 	 	 	 	  
 	 	 	 	 / /   I f   w e   h a v e   a   s t r i n g ,   t h a t   m e a n s   t h a t   w e   h a v e   a n   e r r o r ,   s o   a d d   i t   t o   t h e   e r r o r   m e s s a g e .  
 	 	 	 	 i f   ( t y p e o f   e r r o r M s g   = =   ' s t r i n g ' )   {  
 	 	 	 	 	 p r o m p t T e x t   + =   e r r o r M s g   +   " < b r / > " ;  
 	 	 	 	 	 o p t i o n s . i s E r r o r   =   t r u e ;  
 	 	 	 	 	 f i e l d _ e r r o r s + + ;  
 	 	 	 	 } 	  
 	 	 	 }  
 	 	 	 / /   I f   t h e   r u l e s   r e q u i r e d   i s   n o t   a d d e d ,   a n   e m p t y   f i e l d   i s   n o t   v a l i d a t e d  
 	 	 	 / / t h e   3 r d   c o n d i t i o n   i s   a d d e d   s o   t h a t   e v e n   e m p t y   p a s s w o r d   f i e l d s   s h o u l d   b e   e q u a l  
 	 	 	 / / o t h e r w i s e   i f   o n e   i s   f i l l e d   a n d   a n o t h e r   l e f t   e m p t y ,   t h e   " e q u a l "   c o n d i t i o n   w o u l d   f a i l  
 	 	 	 / / w h i c h   d o e s   n o t   m a k e   a n y   s e n s e  
 	 	 	 i f ( ! r e q u i r e d   & &   ! ( f i e l d . v a l ( ) )   & &   f i e l d . v a l ( ) . l e n g t h   <   1   & &   r u l e s . i n d e x O f ( " e q u a l s " )   <   0 )   o p t i o n s . i s E r r o r   =   f a l s e ;  
  
 	 	 	 / /   H a c k   f o r   r a d i o / c h e c k b o x   g r o u p   b u t t o n ,   t h e   v a l i d a t i o n   g o   i n t o   t h e  
 	 	 	 / /   f i r s t   r a d i o / c h e c k b o x   o f   t h e   g r o u p  
 	 	 	 v a r   f i e l d T y p e   =   f i e l d . p r o p ( " t y p e " ) ;  
 	 	 	 v a r   p o s i t i o n T y p e = f i e l d . d a t a ( " p r o m p t P o s i t i o n " )   | |   o p t i o n s . p r o m p t P o s i t i o n ;  
  
 	 	 	 i f   ( ( f i e l d T y p e   = =   " r a d i o "   | |   f i e l d T y p e   = =   " c h e c k b o x " )   & &   f o r m . f i n d ( " i n p u t [ n a m e = ' "   +   f i e l d N a m e   +   " ' ] " ) . s i z e ( )   >   1 )   {  
 	 	 	 	 i f ( p o s i t i o n T y p e   = = =   ' i n l i n e ' )   {  
 	 	 	 	 	 f i e l d   =   $ ( f o r m . f i n d ( " i n p u t [ n a m e = ' "   +   f i e l d N a m e   +   " ' ] [ t y p e ! = h i d d e n ] : l a s t " ) ) ;  
 	 	 	 	 }   e l s e   {  
 	 	 	 	 f i e l d   =   $ ( f o r m . f i n d ( " i n p u t [ n a m e = ' "   +   f i e l d N a m e   +   " ' ] [ t y p e ! = h i d d e n ] : f i r s t " ) ) ;  
 	 	 	 	 }  
 	 	 	 	 o p t i o n s . s h o w A r r o w   =   f a l s e ;  
 	 	 	 }  
  
 	 	 	 i f ( f i e l d . i s ( " : h i d d e n " )   & &   o p t i o n s . p r e t t y S e l e c t )   {  
 	 	 	 	 f i e l d   =   f o r m . f i n d ( " # "   +   o p t i o n s . u s e P r e f i x   +   m e t h o d s . _ j q S e l e c t o r ( f i e l d . a t t r ( ' i d ' ) )   +   o p t i o n s . u s e S u f f i x ) ;  
 	 	 	 }  
  
 	 	 	 i f   ( o p t i o n s . i s E r r o r   & &   o p t i o n s . s h o w P r o m p t s ) {  
 	 	 	 	 m e t h o d s . _ s h o w P r o m p t ( f i e l d ,   p r o m p t T e x t ,   p r o m p t T y p e ,   f a l s e ,   o p t i o n s ) ;  
 	 	 	 } e l s e {  
 	 	 	 	 i f   ( ! i s A j a x V a l i d a t o r )   m e t h o d s . _ c l o s e P r o m p t ( f i e l d ) ;  
 	 	 	 }  
  
 	 	 	 i f   ( ! i s A j a x V a l i d a t o r )   {  
 	 	 	 	 f i e l d . t r i g g e r ( " j q v . f i e l d . r e s u l t " ,   [ f i e l d ,   o p t i o n s . i s E r r o r ,   p r o m p t T e x t ] ) ;  
 	 	 	 }  
  
 	 	 	 / *   R e c o r d   e r r o r   * /  
 	 	 	 v a r   e r r i n d e x   =   $ . i n A r r a y ( f i e l d [ 0 ] ,   o p t i o n s . I n v a l i d F i e l d s ) ;  
 	 	 	 i f   ( e r r i n d e x   = =   - 1 )   {  
 	 	 	 	 i f   ( o p t i o n s . i s E r r o r )  
 	 	 	 	 o p t i o n s . I n v a l i d F i e l d s . p u s h ( f i e l d [ 0 ] ) ;  
 	 	 	 }   e l s e   i f   ( ! o p t i o n s . i s E r r o r )   {  
 	 	 	 	 o p t i o n s . I n v a l i d F i e l d s . s p l i c e ( e r r i n d e x ,   1 ) ;  
 	 	 	 }  
 	 	 	 	  
 	 	 	 m e t h o d s . _ h a n d l e S t a t u s C s s C l a s s e s ( f i e l d ,   o p t i o n s ) ;  
 	  
 	 	 	 / *   r u n   c a l l b a c k   f u n c t i o n   f o r   e a c h   f i e l d   * /  
 	 	 	 i f   ( o p t i o n s . i s E r r o r   & &   o p t i o n s . o n F i e l d F a i l u r e )  
 	 	 	 	 o p t i o n s . o n F i e l d F a i l u r e ( f i e l d ) ;  
  
 	 	 	 i f   ( ! o p t i o n s . i s E r r o r   & &   o p t i o n s . o n F i e l d S u c c e s s )  
 	 	 	 	 o p t i o n s . o n F i e l d S u c c e s s ( f i e l d ) ;  
  
 	 	 	 r e t u r n   o p t i o n s . i s E r r o r ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   H a n d l i n g   c s s   c l a s s e s   o f   f i e l d s   i n d i c a t i n g   r e s u l t   o f   v a l i d a t i o n    
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }  
 	 	 *                         f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }  
 	 	 *                         f i e l d ' s   v a l i d a t i o n   r u l e s                          
 	 	 *   @ p r i v a t e  
 	 	 * /  
 	 	 _ h a n d l e S t a t u s C s s C l a s s e s :   f u n c t i o n ( f i e l d ,   o p t i o n s )   {  
 	 	 	 / *   r e m o v e   a l l   c l a s s e s   * /  
 	 	 	 i f ( o p t i o n s . a d d S u c c e s s C s s C l a s s T o F i e l d )  
 	 	 	 	 f i e l d . r e m o v e C l a s s ( o p t i o n s . a d d S u c c e s s C s s C l a s s T o F i e l d ) ;  
 	 	 	  
 	 	 	 i f ( o p t i o n s . a d d F a i l u r e C s s C l a s s T o F i e l d )  
 	 	 	 	 f i e l d . r e m o v e C l a s s ( o p t i o n s . a d d F a i l u r e C s s C l a s s T o F i e l d ) ;  
 	 	 	  
 	 	 	 / *   A d d   c l a s s e s   * /  
 	 	 	 i f   ( o p t i o n s . a d d S u c c e s s C s s C l a s s T o F i e l d   & &   ! o p t i o n s . i s E r r o r )  
 	 	 	 	 f i e l d . a d d C l a s s ( o p t i o n s . a d d S u c c e s s C s s C l a s s T o F i e l d ) ;  
 	 	 	  
 	 	 	 i f   ( o p t i o n s . a d d F a i l u r e C s s C l a s s T o F i e l d   & &   o p t i o n s . i s E r r o r )  
 	 	 	 	 f i e l d . a d d C l a s s ( o p t i o n s . a d d F a i l u r e C s s C l a s s T o F i e l d ) ; 	 	  
 	 	 } ,  
 	 	  
 	 	   / * * * * * * * * * * * * * * * * * * * *  
 	 	     *   _ g e t E r r o r M e s s a g e  
 	 	     *  
 	 	     *   @ p a r a m   f o r m  
 	 	     *   @ p a r a m   f i e l d  
 	 	     *   @ p a r a m   r u l e  
 	 	     *   @ p a r a m   r u l e s  
 	 	     *   @ p a r a m   i  
 	 	     *   @ p a r a m   o p t i o n s  
 	 	     *   @ p a r a m   o r i g i n a l V a l i d a t i o n M e t h o d  
 	 	     *   @ r e t u r n   { * }  
 	 	     *   @ p r i v a t e  
 	 	     * /  
 	 	   _ g e t E r r o r M e s s a g e : f u n c t i o n   ( f o r m ,   f i e l d ,   r u l e ,   r u l e s ,   i ,   o p t i o n s ,   o r i g i n a l V a l i d a t i o n M e t h o d )   {  
 	 	 	   / /   I f   w e   a r e   u s i n g   t h e   c u s t o n   v a l i d a t i o n   t y p e ,   b u i l d   t h e   i n d e x   f o r   t h e   r u l e .  
 	 	 	   / /   O t h e r w i s e   i f   w e   a r e   d o i n g   a   f u n c t i o n   c a l l ,   m a k e   t h e   c a l l   a n d   r e t u r n   t h e   o b j e c t  
 	 	 	   / /   t h a t   i s   p a s s e d   b a c k .  
 	   	 	   v a r   r u l e _ i n d e x   =   j Q u e r y . i n A r r a y ( r u l e ,   r u l e s ) ;  
 	 	 	   i f   ( r u l e   = = =   " c u s t o m "   | |   r u l e   = = =   " f u n c C a l l " )   {  
 	 	 	 	   v a r   c u s t o m _ v a l i d a t i o n _ t y p e   =   r u l e s [ r u l e _ i n d e x   +   1 ] ;  
 	 	 	 	   r u l e   =   r u l e   +   " [ "   +   c u s t o m _ v a l i d a t i o n _ t y p e   +   " ] " ;  
 	 	 	 	   / /   D e l e t e   t h e   r u l e   f r o m   t h e   r u l e s   a r r a y   s o   t h a t   i t   d o e s n ' t   t r y   t o   c a l l   t h e  
 	 	 	         / /   s a m e   r u l e   o v e r   a g a i n  
 	 	 	         d e l e t e ( r u l e s [ r u l e _ i n d e x ] ) ;  
 	 	 	   }  
 	 	 	   / /   C h a n g e   t h e   r u l e   t o   t h e   c o m p o s i t e   r u l e ,   i f   i t   w a s   d i f f e r e n t   f r o m   t h e   o r i g i n a l  
 	 	 	   v a r   a l t e r e d R u l e   =   r u l e ;  
  
  
 	 	 	   v a r   e l e m e n t _ c l a s s e s   =   ( f i e l d . a t t r ( " d a t a - v a l i d a t i o n - e n g i n e " ) )   ?   f i e l d . a t t r ( " d a t a - v a l i d a t i o n - e n g i n e " )   :   f i e l d . a t t r ( " c l a s s " ) ;  
 	 	 	   v a r   e l e m e n t _ c l a s s e s _ a r r a y   =   e l e m e n t _ c l a s s e s . s p l i t ( "   " ) ;  
  
 	 	 	   / /   C a l l   t h e   o r i g i n a l   v a l i d a t i o n   m e t h o d .   I f   w e   a r e   d e a l i n g   w i t h   d a t e s   o r   c h e c k b o x e s ,   a l s o   p a s s   t h e   f o r m  
 	 	 	   v a r   e r r o r M s g ;  
 	 	 	   i f   ( r u l e   = =   " f u t u r e "   | |   r u l e   = =   " p a s t "     | |   r u l e   = =   " m a x C h e c k b o x "   | |   r u l e   = =   " m i n C h e c k b o x " )   {  
 	 	 	 	   e r r o r M s g   =   o r i g i n a l V a l i d a t i o n M e t h o d ( f o r m ,   f i e l d ,   r u l e s ,   i ,   o p t i o n s ) ;  
 	 	 	   }   e l s e   {  
 	 	 	 	   e r r o r M s g   =   o r i g i n a l V a l i d a t i o n M e t h o d ( f i e l d ,   r u l e s ,   i ,   o p t i o n s ) ;  
 	 	 	   }  
  
 	 	 	   / /   I f   t h e   o r i g i n a l   v a l i d a t i o n   m e t h o d   r e t u r n e d   a n   e r r o r   a n d   w e   h a v e   a   c u s t o m   e r r o r   m e s s a g e ,  
 	 	 	   / /   r e t u r n   t h e   c u s t o m   m e s s a g e   i n s t e a d .   O t h e r w i s e   r e t u r n   t h e   o r i g i n a l   e r r o r   m e s s a g e .  
 	 	 	   i f   ( e r r o r M s g   ! =   u n d e f i n e d )   {  
 	 	 	 	   v a r   c u s t o m _ m e s s a g e   =   m e t h o d s . _ g e t C u s t o m E r r o r M e s s a g e ( $ ( f i e l d ) ,   e l e m e n t _ c l a s s e s _ a r r a y ,   a l t e r e d R u l e ,   o p t i o n s ) ;  
 	 	 	 	   i f   ( c u s t o m _ m e s s a g e )   e r r o r M s g   =   c u s t o m _ m e s s a g e ;  
 	 	 	   }  
 	 	 	   r e t u r n   e r r o r M s g ;  
  
 	 	   } ,  
 	 	   _ g e t C u s t o m E r r o r M e s s a g e : f u n c t i o n   ( f i e l d ,   c l a s s e s ,   r u l e ,   o p t i o n s )   {  
 	 	 	 v a r   c u s t o m _ m e s s a g e   =   f a l s e ;  
 	 	 	 v a r   v a l i d i t y P r o p   =   / ^ c u s t o m \ [ . * \ ] $ / . t e s t ( r u l e )   ?   m e t h o d s . _ v a l i d i t y P r o p [ " c u s t o m " ]   :   m e t h o d s . _ v a l i d i t y P r o p [ r u l e ] ;  
 	 	 	   / /   I f   t h e r e   i s   a   v a l i d i t y P r o p   f o r   t h i s   r u l e ,   c h e c k   t o   s e e   i f   t h e   f i e l d   h a s   a n   a t t r i b u t e   f o r   i t  
 	 	 	 i f   ( v a l i d i t y P r o p   ! =   u n d e f i n e d )   {  
 	 	 	 	 c u s t o m _ m e s s a g e   =   f i e l d . a t t r ( " d a t a - e r r o r m e s s a g e - " + v a l i d i t y P r o p ) ;  
 	 	 	 	 / /   I f   t h e r e   w a s   a n   e r r o r   m e s s a g e   f o r   i t ,   r e t u r n   t h e   m e s s a g e  
 	 	 	 	 i f   ( c u s t o m _ m e s s a g e   ! =   u n d e f i n e d )    
 	 	 	 	 	 r e t u r n   c u s t o m _ m e s s a g e ;  
 	 	 	 }  
 	 	 	 c u s t o m _ m e s s a g e   =   f i e l d . a t t r ( " d a t a - e r r o r m e s s a g e " ) ;  
 	 	 	   / /   I f   t h e r e   i s   a n   i n l i n e   c u s t o m   e r r o r   m e s s a g e ,   r e t u r n   i t  
 	 	 	 i f   ( c u s t o m _ m e s s a g e   ! =   u n d e f i n e d )    
 	 	 	 	 r e t u r n   c u s t o m _ m e s s a g e ;  
 	 	 	 v a r   i d   =   ' # '   +   f i e l d . a t t r ( " i d " ) ;  
 	 	 	 / /   I f   w e   h a v e   c u s t o m   m e s s a g e s   f o r   t h e   e l e m e n t ' s   i d ,   g e t   t h e   m e s s a g e   f o r   t h e   r u l e   f r o m   t h e   i d .  
 	 	 	 / /   O t h e r w i s e ,   i f   w e   h a v e   c u s t o m   m e s s a g e s   f o r   t h e   e l e m e n t ' s   c l a s s e s ,   u s e   t h e   f i r s t   c l a s s   m e s s a g e   w e   f i n d   i n s t e a d .  
 	 	 	 i f   ( t y p e o f   o p t i o n s . c u s t o m _ e r r o r _ m e s s a g e s [ i d ]   ! =   " u n d e f i n e d "   & &  
 	 	 	 	 t y p e o f   o p t i o n s . c u s t o m _ e r r o r _ m e s s a g e s [ i d ] [ r u l e ]   ! =   " u n d e f i n e d "   )   {  
 	 	 	 	 	 	     c u s t o m _ m e s s a g e   =   o p t i o n s . c u s t o m _ e r r o r _ m e s s a g e s [ i d ] [ r u l e ] [ ' m e s s a g e ' ] ;  
 	 	 	 }   e l s e   i f   ( c l a s s e s . l e n g t h   >   0 )   {  
 	 	 	 	 f o r   ( v a r   i   =   0 ;   i   <   c l a s s e s . l e n g t h   & &   c l a s s e s . l e n g t h   >   0 ;   i + + )   {  
 	 	 	 	 	   v a r   e l e m e n t _ c l a s s   =   " . "   +   c l a s s e s [ i ] ;  
 	 	 	 	 	 i f   ( t y p e o f   o p t i o n s . c u s t o m _ e r r o r _ m e s s a g e s [ e l e m e n t _ c l a s s ]   ! =   " u n d e f i n e d "   & &  
 	 	 	 	 	 	 t y p e o f   o p t i o n s . c u s t o m _ e r r o r _ m e s s a g e s [ e l e m e n t _ c l a s s ] [ r u l e ]   ! =   " u n d e f i n e d " )   {  
 	 	 	 	 	 	 	 c u s t o m _ m e s s a g e   =   o p t i o n s . c u s t o m _ e r r o r _ m e s s a g e s [ e l e m e n t _ c l a s s ] [ r u l e ] [ ' m e s s a g e ' ] ;  
 	 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 }  
 	 	 	 	 }  
 	 	 	 }  
 	 	 	 i f   ( ! c u s t o m _ m e s s a g e   & &  
 	 	 	 	 t y p e o f   o p t i o n s . c u s t o m _ e r r o r _ m e s s a g e s [ r u l e ]   ! =   " u n d e f i n e d "   & &  
 	 	 	 	 t y p e o f   o p t i o n s . c u s t o m _ e r r o r _ m e s s a g e s [ r u l e ] [ ' m e s s a g e ' ]   ! =   " u n d e f i n e d " ) {  
 	 	 	 	 	   c u s t o m _ m e s s a g e   =   o p t i o n s . c u s t o m _ e r r o r _ m e s s a g e s [ r u l e ] [ ' m e s s a g e ' ] ;  
 	 	 	   }  
 	 	 	   r e t u r n   c u s t o m _ m e s s a g e ;  
 	 	   } ,  
 	 	   _ v a l i d i t y P r o p :   {  
 	 	 	   " r e q u i r e d " :   " v a l u e - m i s s i n g " ,  
 	 	 	   " c u s t o m " :   " c u s t o m - e r r o r " ,  
 	 	 	   " g r o u p R e q u i r e d " :   " v a l u e - m i s s i n g " ,  
 	 	 	   " a j a x " :   " c u s t o m - e r r o r " ,  
 	 	 	   " m i n S i z e " :   " r a n g e - u n d e r f l o w " ,  
 	 	 	   " m a x S i z e " :   " r a n g e - o v e r f l o w " ,  
 	 	 	   " m i n " :   " r a n g e - u n d e r f l o w " ,  
 	 	 	   " m a x " :   " r a n g e - o v e r f l o w " ,  
 	 	 	   " p a s t " :   " t y p e - m i s m a t c h " ,  
 	 	 	   " f u t u r e " :   " t y p e - m i s m a t c h " ,  
 	 	 	   " d a t e R a n g e " :   " t y p e - m i s m a t c h " ,  
 	 	 	   " d a t e T i m e R a n g e " :   " t y p e - m i s m a t c h " ,  
 	 	 	   " m a x C h e c k b o x " :   " r a n g e - o v e r f l o w " ,  
 	 	 	   " m i n C h e c k b o x " :   " r a n g e - u n d e r f l o w " ,  
 	 	 	   " e q u a l s " :   " p a t t e r n - m i s m a t c h " ,  
 	 	 	   " f u n c C a l l " :   " c u s t o m - e r r o r " ,  
 	 	 	   " c r e d i t C a r d " :   " p a t t e r n - m i s m a t c h " ,  
 	 	 	   " c o n d R e q u i r e d " :   " v a l u e - m i s s i n g "  
 	 	   } ,  
 	 	 / * *  
 	 	 *   R e q u i r e d   v a l i d a t i o n  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ p a r a m   { b o o l }   c o n d R e q u i r e d   f l a g   w h e n   m e t h o d   i s   u s e d   f o r   i n t e r n a l   p u r p o s e   i n   c o n d R e q u i r e d   c h e c k  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ r e q u i r e d :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s ,   c o n d R e q u i r e d )   {  
 	 	 	 s w i t c h   ( f i e l d . p r o p ( " t y p e " ) )   {  
 	 	 	 	 c a s e   " t e x t " :  
 	 	 	 	 c a s e   " p a s s w o r d " :  
 	 	 	 	 c a s e   " t e x t a r e a " :  
 	 	 	 	 c a s e   " f i l e " :  
 	 	 	 	 c a s e   " s e l e c t - o n e " :  
 	 	 	 	 c a s e   " s e l e c t - m u l t i p l e " :  
 	 	 	 	 d e f a u l t :  
 	 	 	 	 	 v a r   f i e l d _ v a l             =   $ . t r i m (   f i e l d . v a l ( )                                                               ) ;  
 	 	 	 	 	 v a r   d v _ p l a c e h o l d e r   =   $ . t r i m (   f i e l d . a t t r ( " d a t a - v a l i d a t i o n - p l a c e h o l d e r " )   ) ;  
 	 	 	 	 	 v a r   p l a c e h o l d e r         =   $ . t r i m (   f i e l d . a t t r ( " p l a c e h o l d e r " )                                   ) ;  
 	 	 	 	 	 i f   (  
 	 	 	 	 	 	       (   ! f i e l d _ v a l                                                                         )  
 	 	 	 	 	 	 | |   (   d v _ p l a c e h o l d e r   & &   f i e l d _ v a l   = =   d v _ p l a c e h o l d e r   )  
 	 	 	 	 	 	 | |   (   p l a c e h o l d e r         & &   f i e l d _ v a l   = =   p l a c e h o l d e r         )  
 	 	 	 	 	 )   {  
 	 	 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t ;  
 	 	 	 	 	 }  
 	 	 	 	 	 b r e a k ;  
 	 	 	 	 c a s e   " r a d i o " :  
 	 	 	 	 c a s e   " c h e c k b o x " :  
 	 	 	 	 	 / /   n e w   v a l i d a t i o n   s t y l e   t o   o n l y   c h e c k   d e p e n d e n t   f i e l d  
 	 	 	 	 	 i f   ( c o n d R e q u i r e d )   {  
 	 	 	 	 	 	 i f   ( ! f i e l d . a t t r ( ' c h e c k e d ' ) )   {  
 	 	 	 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t C h e c k b o x M u l t i p l e ;  
 	 	 	 	 	 	 }  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 }  
 	 	 	 	 	 / /   o l d   v a l i d a t i o n   s t y l e  
 	 	 	 	 	 v a r   f o r m   =   f i e l d . c l o s e s t ( " f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r " ) ;  
 	 	 	 	 	 v a r   n a m e   =   f i e l d . a t t r ( " n a m e " ) ;  
 	 	 	 	 	 i f   ( f o r m . f i n d ( " i n p u t [ n a m e = ' "   +   n a m e   +   " ' ] : c h e c k e d " ) . s i z e ( )   = =   0 )   {  
 	 	 	 	 	 	 i f   ( f o r m . f i n d ( " i n p u t [ n a m e = ' "   +   n a m e   +   " ' ] : v i s i b l e " ) . s i z e ( )   = =   1 )  
 	 	 	 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t C h e c k b o x e ;  
 	 	 	 	 	 	 e l s e  
 	 	 	 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t C h e c k b o x M u l t i p l e ;  
 	 	 	 	 	 }  
 	 	 	 	 	 b r e a k ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   V a l i d a t e   t h a t   1   f r o m   t h e   g r o u p   f i e l d   i s   r e q u i r e d  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ g r o u p R e q u i r e d :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 v a r   c l a s s G r o u p   =   " [ " + o p t i o n s . v a l i d a t e A t t r i b u t e + " * = "   + r u l e s [ i   +   1 ]   + " ] " ;  
 	 	 	 v a r   i s V a l i d   =   f a l s e ;  
 	 	 	 / /   C h e c k   a l l   f i e l d s   f r o m   t h e   g r o u p  
 	 	 	 f i e l d . c l o s e s t ( " f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r " ) . f i n d ( c l a s s G r o u p ) . e a c h ( f u n c t i o n ( ) {  
 	 	 	 	 i f ( ! m e t h o d s . _ r e q u i r e d ( $ ( t h i s ) ,   r u l e s ,   i ,   o p t i o n s ) ) {  
 	 	 	 	 	 i s V a l i d   =   t r u e ;  
 	 	 	 	 	 r e t u r n   f a l s e ;  
 	 	 	 	 }  
 	 	 	 } ) ;    
  
 	 	 	 i f ( ! i s V a l i d )   {  
 	 	     r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t ;  
 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   V a l i d a t e   r u l e s  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ c u s t o m :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 v a r   c u s t o m R u l e   =   r u l e s [ i   +   1 ] ;  
 	 	 	 v a r   r u l e   =   o p t i o n s . a l l r u l e s [ c u s t o m R u l e ] ;  
 	 	 	 v a r   f n ;  
 	 	 	 i f ( ! r u l e )   {  
 	 	 	 	 a l e r t ( " j q v : c u s t o m   r u l e   n o t   f o u n d   -   " + c u s t o m R u l e ) ;  
 	 	 	 	 r e t u r n ;  
 	 	 	 }  
 	 	 	  
 	 	 	 i f ( r u l e [ " r e g e x " ] )   {  
 	 	 	 	   v a r   e x = r u l e . r e g e x ;  
 	 	 	 	 	 i f ( ! e x )   {  
 	 	 	 	 	 	 a l e r t ( " j q v : c u s t o m   r e g e x   n o t   f o u n d   -   " + c u s t o m R u l e ) ;  
 	 	 	 	 	 	 r e t u r n ;  
 	 	 	 	 	 }  
 	 	 	 	 	 v a r   p a t t e r n   =   n e w   R e g E x p ( e x ) ;  
  
 	 	 	 	 	 i f   ( ! p a t t e r n . t e s t ( f i e l d . v a l ( ) ) )   r e t u r n   o p t i o n s . a l l r u l e s [ c u s t o m R u l e ] . a l e r t T e x t ;  
 	 	 	 	 	  
 	 	 	 }   e l s e   i f ( r u l e [ " f u n c " ] )   {  
 	 	 	 	 f n   =   r u l e [ " f u n c " ] ;    
 	 	 	 	    
 	 	 	 	 i f   ( t y p e o f ( f n )   ! = =   " f u n c t i o n " )   {  
 	 	 	 	 	 a l e r t ( " j q v : c u s t o m   p a r a m e t e r   ' f u n c t i o n '   i s   n o   f u n c t i o n   -   " + c u s t o m R u l e ) ;  
 	 	 	 	 	 	 r e t u r n ;  
 	 	 	 	 }  
 	 	 	 	    
 	 	 	 	 i f   ( ! f n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s ) )  
 	 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ c u s t o m R u l e ] . a l e r t T e x t ;  
 	 	 	 }   e l s e   {  
 	 	 	 	 a l e r t ( " j q v : c u s t o m   t y p e   n o t   a l l o w e d   " + c u s t o m R u l e ) ;  
 	 	 	 	 	 r e t u r n ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   V a l i d a t e   c u s t o m   f u n c t i o n   o u t s i d e   o f   t h e   e n g i n e   s c o p e  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ f u n c C a l l :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 v a r   f u n c t i o n N a m e   =   r u l e s [ i   +   1 ] ;  
 	 	 	 v a r   f n ;  
 	 	 	 i f ( f u n c t i o n N a m e . i n d e x O f ( ' . ' )   > - 1 )  
 	 	 	 {  
 	 	 	 	 v a r   n a m e s p a c e s   =   f u n c t i o n N a m e . s p l i t ( ' . ' ) ;  
 	 	 	 	 v a r   s c o p e   =   w i n d o w ;  
 	 	 	 	 w h i l e ( n a m e s p a c e s . l e n g t h )  
 	 	 	 	 {  
 	 	 	 	 	 s c o p e   =   s c o p e [ n a m e s p a c e s . s h i f t ( ) ] ;  
 	 	 	 	 }  
 	 	 	 	 f n   =   s c o p e ;  
 	 	 	 }  
 	 	 	 e l s e  
 	 	 	 	 f n   =   w i n d o w [ f u n c t i o n N a m e ]   | |   o p t i o n s . c u s t o m F u n c t i o n s [ f u n c t i o n N a m e ] ;  
 	 	 	 i f   ( t y p e o f ( f n )   = =   ' f u n c t i o n ' )  
 	 	 	 	 r e t u r n   f n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s ) ;  
  
 	 	 } ,  
 	 	 / * *  
 	 	 *   F i e l d   m a t c h  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ e q u a l s :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 v a r   e q u a l s F i e l d   =   r u l e s [ i   +   1 ] ;  
  
 	 	 	 i f   ( f i e l d . v a l ( )   ! =   $ ( " # "   +   e q u a l s F i e l d ) . v a l ( ) )  
 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s . e q u a l s . a l e r t T e x t ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k   t h e   m a x i m u m   s i z e   ( i n   c h a r a c t e r s )  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ m a x S i z e :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 v a r   m a x   =   r u l e s [ i   +   1 ] ;  
 	 	 	 v a r   l e n   =   f i e l d . v a l ( ) . l e n g t h ;  
  
 	 	 	 i f   ( l e n   >   m a x )   {  
 	 	 	 	 v a r   r u l e   =   o p t i o n s . a l l r u l e s . m a x S i z e ;  
 	 	 	 	 r e t u r n   r u l e . a l e r t T e x t   +   m a x   +   r u l e . a l e r t T e x t 2 ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k   t h e   m i n i m u m   s i z e   ( i n   c h a r a c t e r s )  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ m i n S i z e :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 v a r   m i n   =   r u l e s [ i   +   1 ] ;  
 	 	 	 v a r   l e n   =   f i e l d . v a l ( ) . l e n g t h ;  
  
 	 	 	 i f   ( l e n   <   m i n )   {  
 	 	 	 	 v a r   r u l e   =   o p t i o n s . a l l r u l e s . m i n S i z e ;  
 	 	 	 	 r e t u r n   r u l e . a l e r t T e x t   +   m i n   +   r u l e . a l e r t T e x t 2 ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k   n u m b e r   m i n i m u m   v a l u e  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ m i n :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 v a r   m i n   =   p a r s e F l o a t ( r u l e s [ i   +   1 ] ) ;  
 	 	 	 v a r   l e n   =   p a r s e F l o a t ( f i e l d . v a l ( ) ) ;  
  
 	 	 	 i f   ( l e n   <   m i n )   {  
 	 	 	 	 v a r   r u l e   =   o p t i o n s . a l l r u l e s . m i n ;  
 	 	 	 	 i f   ( r u l e . a l e r t T e x t 2 )   r e t u r n   r u l e . a l e r t T e x t   +   m i n   +   r u l e . a l e r t T e x t 2 ;  
 	 	 	 	 r e t u r n   r u l e . a l e r t T e x t   +   m i n ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k   n u m b e r   m a x i m u m   v a l u e  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ m a x :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 v a r   m a x   =   p a r s e F l o a t ( r u l e s [ i   +   1 ] ) ;  
 	 	 	 v a r   l e n   =   p a r s e F l o a t ( f i e l d . v a l ( ) ) ;  
  
 	 	 	 i f   ( l e n   > m a x   )   {  
 	 	 	 	 v a r   r u l e   =   o p t i o n s . a l l r u l e s . m a x ;  
 	 	 	 	 i f   ( r u l e . a l e r t T e x t 2 )   r e t u r n   r u l e . a l e r t T e x t   +   m a x   +   r u l e . a l e r t T e x t 2 ;  
 	 	 	 	 / / o r e f a l o :   t o   r e v i e w ,   a l s o   d o   t h e   t r a n s l a t i o n s  
 	 	 	 	 r e t u r n   r u l e . a l e r t T e x t   +   m a x ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k s   d a t e   i s   i n   t h e   p a s t  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ p a s t :   f u n c t i o n ( f o r m ,   f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
  
 	 	 	 v a r   p = r u l e s [ i   +   1 ] ;  
 	 	 	 v a r   f i e l d A l t   =   $ ( f o r m . f i n d ( " * [ n a m e = ' "   +   p . r e p l a c e ( / ^ # + / ,   ' ' )   +   " ' ] " ) ) ;  
 	 	 	 v a r   p d a t e ;  
  
 	 	 	 i f   ( p . t o L o w e r C a s e ( )   = =   " n o w " )   {  
 	 	 	 	 p d a t e   =   n e w   D a t e ( ) ;  
 	 	 	 }   e l s e   i f   ( u n d e f i n e d   ! =   f i e l d A l t . v a l ( ) )   {  
 	 	 	 	 i f   ( f i e l d A l t . i s ( " : d i s a b l e d " ) )  
 	 	 	 	 	 r e t u r n ;  
 	 	 	 	 p d a t e   =   m e t h o d s . _ p a r s e D a t e ( f i e l d A l t . v a l ( ) ) ;  
 	 	 	 }   e l s e   {  
 	 	 	 	 p d a t e   =   m e t h o d s . _ p a r s e D a t e ( p ) ;  
 	 	 	 }  
 	 	 	 v a r   v d a t e   =   m e t h o d s . _ p a r s e D a t e ( f i e l d . v a l ( ) ) ;  
  
 	 	 	 i f   ( v d a t e   >   p d a t e   )   {  
 	 	 	 	 v a r   r u l e   =   o p t i o n s . a l l r u l e s . p a s t ;  
 	 	 	 	 i f   ( r u l e . a l e r t T e x t 2 )   r e t u r n   r u l e . a l e r t T e x t   +   m e t h o d s . _ d a t e T o S t r i n g ( p d a t e )   +   r u l e . a l e r t T e x t 2 ;  
 	 	 	 	 r e t u r n   r u l e . a l e r t T e x t   +   m e t h o d s . _ d a t e T o S t r i n g ( p d a t e ) ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k s   d a t e   i s   i n   t h e   f u t u r e  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ f u t u r e :   f u n c t i o n ( f o r m ,   f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
  
 	 	 	 v a r   p = r u l e s [ i   +   1 ] ;  
 	 	 	 v a r   f i e l d A l t   =   $ ( f o r m . f i n d ( " * [ n a m e = ' "   +   p . r e p l a c e ( / ^ # + / ,   ' ' )   +   " ' ] " ) ) ;  
 	 	 	 v a r   p d a t e ;  
  
 	 	 	 i f   ( p . t o L o w e r C a s e ( )   = =   " n o w " )   {  
 	 	 	 	 p d a t e   =   n e w   D a t e ( ) ;  
 	 	 	 }   e l s e   i f   ( u n d e f i n e d   ! =   f i e l d A l t . v a l ( ) )   {  
 	 	 	 	 i f   ( f i e l d A l t . i s ( " : d i s a b l e d " ) )  
 	 	 	 	 	 r e t u r n ;  
 	 	 	 	 p d a t e   =   m e t h o d s . _ p a r s e D a t e ( f i e l d A l t . v a l ( ) ) ;  
 	 	 	 }   e l s e   {  
 	 	 	 	 p d a t e   =   m e t h o d s . _ p a r s e D a t e ( p ) ;  
 	 	 	 }  
 	 	 	 v a r   v d a t e   =   m e t h o d s . _ p a r s e D a t e ( f i e l d . v a l ( ) ) ;  
  
 	 	 	 i f   ( v d a t e   <   p d a t e   )   {  
 	 	 	 	 v a r   r u l e   =   o p t i o n s . a l l r u l e s . f u t u r e ;  
 	 	 	 	 i f   ( r u l e . a l e r t T e x t 2 )  
 	 	 	 	 	 r e t u r n   r u l e . a l e r t T e x t   +   m e t h o d s . _ d a t e T o S t r i n g ( p d a t e )   +   r u l e . a l e r t T e x t 2 ;  
 	 	 	 	 r e t u r n   r u l e . a l e r t T e x t   +   m e t h o d s . _ d a t e T o S t r i n g ( p d a t e ) ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k s   i f   v a l i d   d a t e  
 	 	 *  
 	 	 *   @ p a r a m   { s t r i n g }   d a t e   s t r i n g  
 	 	 *   @ r e t u r n   a   b o o l   b a s e d   o n   d e t e r m i n a t i o n   o f   v a l i d   d a t e  
 	 	 * /  
 	 	 _ i s D a t e :   f u n c t i o n   ( v a l u e )   {  
 	 	 	 v a r   d a t e R e g E x   =   n e w   R e g E x p ( / ^ \ d { 4 } [ \ / \ - ] ( 0 ? [ 1 - 9 ] | 1 [ 0 1 2 ] ) [ \ / \ - ] ( 0 ? [ 1 - 9 ] | [ 1 2 ] [ 0 - 9 ] | 3 [ 0 1 ] ) $ | ^ ( ? : ( ? : ( ? : 0 ? [ 1 3 5 7 8 ] | 1 [ 0 2 ] ) ( \ / | - ) 3 1 ) | ( ? : ( ? : 0 ? [ 1 , 3 - 9 ] | 1 [ 0 - 2 ] ) ( \ / | - ) ( ? : 2 9 | 3 0 ) ) ) ( \ / | - ) ( ? : [ 1 - 9 ] \ d \ d \ d | \ d [ 1 - 9 ] \ d \ d | \ d \ d [ 1 - 9 ] \ d | \ d \ d \ d [ 1 - 9 ] ) $ | ^ ( ? : ( ? : 0 ? [ 1 - 9 ] | 1 [ 0 - 2 ] ) ( \ / | - ) ( ? : 0 ? [ 1 - 9 ] | 1 \ d | 2 [ 0 - 8 ] ) ) ( \ / | - ) ( ? : [ 1 - 9 ] \ d \ d \ d | \ d [ 1 - 9 ] \ d \ d | \ d \ d [ 1 - 9 ] \ d | \ d \ d \ d [ 1 - 9 ] ) $ | ^ ( 0 ? 2 ( \ / | - ) 2 9 ) ( \ / | - ) ( ? : ( ? : 0 [ 4 8 ] 0 0 | [ 1 3 5 7 9 ] [ 2 6 ] 0 0 | [ 2 4 6 8 ] [ 0 4 8 ] 0 0 ) | ( ? : \ d \ d ) ? ( ? : 0 [ 4 8 ] | [ 2 4 6 8 ] [ 0 4 8 ] | [ 1 3 5 7 9 ] [ 2 6 ] ) ) $ / ) ;  
 	 	 	 r e t u r n   d a t e R e g E x . t e s t ( v a l u e ) ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k s   i f   v a l i d   d a t e   t i m e  
 	 	 *  
 	 	 *   @ p a r a m   { s t r i n g }   d a t e   s t r i n g  
 	 	 *   @ r e t u r n   a   b o o l   b a s e d   o n   d e t e r m i n a t i o n   o f   v a l i d   d a t e   t i m e  
 	 	 * /  
 	 	 _ i s D a t e T i m e :   f u n c t i o n   ( v a l u e ) {  
 	 	 	 v a r   d a t e T i m e R e g E x   =   n e w   R e g E x p ( / ^ \ d { 4 } [ \ / \ - ] ( 0 ? [ 1 - 9 ] | 1 [ 0 1 2 ] ) [ \ / \ - ] ( 0 ? [ 1 - 9 ] | [ 1 2 ] [ 0 - 9 ] | 3 [ 0 1 ] ) \ s + ( 1 [ 0 1 2 ] | 0 ? [ 1 - 9 ] ) { 1 } : ( 0 ? [ 1 - 5 ] | [ 0 - 6 ] [ 0 - 9 ] ) { 1 } : ( 0 ? [ 0 - 6 ] | [ 0 - 6 ] [ 0 - 9 ] ) { 1 } \ s + ( a m | p m | A M | P M ) { 1 } $ | ^ ( ? : ( ? : ( ? : 0 ? [ 1 3 5 7 8 ] | 1 [ 0 2 ] ) ( \ / | - ) 3 1 ) | ( ? : ( ? : 0 ? [ 1 , 3 - 9 ] | 1 [ 0 - 2 ] ) ( \ / | - ) ( ? : 2 9 | 3 0 ) ) ) ( \ / | - ) ( ? : [ 1 - 9 ] \ d \ d \ d | \ d [ 1 - 9 ] \ d \ d | \ d \ d [ 1 - 9 ] \ d | \ d \ d \ d [ 1 - 9 ] ) $ | ^ ( ( 1 [ 0 1 2 ] | 0 ? [ 1 - 9 ] ) { 1 } \ / ( 0 ? [ 1 - 9 ] | [ 1 2 ] [ 0 - 9 ] | 3 [ 0 1 ] ) { 1 } \ / \ d { 2 , 4 } \ s + ( 1 [ 0 1 2 ] | 0 ? [ 1 - 9 ] ) { 1 } : ( 0 ? [ 1 - 5 ] | [ 0 - 6 ] [ 0 - 9 ] ) { 1 } : ( 0 ? [ 0 - 6 ] | [ 0 - 6 ] [ 0 - 9 ] ) { 1 } \ s + ( a m | p m | A M | P M ) { 1 } ) $ / ) ;  
 	 	 	 r e t u r n   d a t e T i m e R e g E x . t e s t ( v a l u e ) ;  
 	 	 } ,  
 	 	 / / C h e c k s   i f   t h e   s t a r t   d a t e   i s   b e f o r e   t h e   e n d   d a t e  
 	 	 / / r e t u r n s   t r u e   i f   e n d   i s   l a t e r   t h a n   s t a r t  
 	 	 _ d a t e C o m p a r e :   f u n c t i o n   ( s t a r t ,   e n d )   {  
 	 	 	 r e t u r n   ( n e w   D a t e ( s t a r t . t o S t r i n g ( ) )   <   n e w   D a t e ( e n d . t o S t r i n g ( ) ) ) ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k s   d a t e   r a n g e  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i r s t   f i e l d   n a m e  
 	 	 *   @ p a r a m   { j q O b j e c t }   s e c o n d   f i e l d   n a m e  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ d a t e R a n g e :   f u n c t i o n   ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 / / a r e   n o t   b o t h   p o p u l a t e d  
 	 	 	 i f   ( ( ! o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e   & &   o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e )   | |   ( o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e   & &   ! o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e ) )   {  
 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t   +   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t 2 ;  
 	 	 	 }  
  
 	 	 	 / / a r e   n o t   b o t h   d a t e s  
 	 	 	 i f   ( ! m e t h o d s . _ i s D a t e ( o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e )   | |   ! m e t h o d s . _ i s D a t e ( o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e ) )   {  
 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t   +   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t 2 ;  
 	 	 	 }  
  
 	 	 	 / / a r e   b o t h   d a t e s   b u t   r a n g e   i s   o f f  
 	 	 	 i f   ( ! m e t h o d s . _ d a t e C o m p a r e ( o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e ,   o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e ) )   {  
 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t   +   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t 2 ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k s   d a t e   t i m e   r a n g e  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i r s t   f i e l d   n a m e  
 	 	 *   @ p a r a m   { j q O b j e c t }   s e c o n d   f i e l d   n a m e  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ d a t e T i m e R a n g e :   f u n c t i o n   ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 / / a r e   n o t   b o t h   p o p u l a t e d  
 	 	 	 i f   ( ( ! o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e   & &   o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e )   | |   ( o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e   & &   ! o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e ) )   {  
 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t   +   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t 2 ;  
 	 	 	 }  
 	 	 	 / / a r e   n o t   b o t h   d a t e s  
 	 	 	 i f   ( ! m e t h o d s . _ i s D a t e T i m e ( o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e )   | |   ! m e t h o d s . _ i s D a t e T i m e ( o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e ) )   {  
 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t   +   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t 2 ;  
 	 	 	 }  
 	 	 	 / / a r e   b o t h   d a t e s   b u t   r a n g e   i s   o f f  
 	 	 	 i f   ( ! m e t h o d s . _ d a t e C o m p a r e ( o p t i o n s . f i r s t O f G r o u p [ 0 ] . v a l u e ,   o p t i o n s . s e c o n d O f G r o u p [ 0 ] . v a l u e ) )   {  
 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t   +   o p t i o n s . a l l r u l e s [ r u l e s [ i ] ] . a l e r t T e x t 2 ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   M a x   n u m b e r   o f   c h e c k b o x   s e l e c t e d  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ m a x C h e c k b o x :   f u n c t i o n ( f o r m ,   f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
  
 	 	 	 v a r   n b C h e c k   =   r u l e s [ i   +   1 ] ;  
 	 	 	 v a r   g r o u p n a m e   =   f i e l d . a t t r ( " n a m e " ) ;  
 	 	 	 v a r   g r o u p S i z e   =   f o r m . f i n d ( " i n p u t [ n a m e = ' "   +   g r o u p n a m e   +   " ' ] : c h e c k e d " ) . s i z e ( ) ;  
 	 	 	 i f   ( g r o u p S i z e   >   n b C h e c k )   {  
 	 	 	 	 o p t i o n s . s h o w A r r o w   =   f a l s e ;  
 	 	 	 	 i f   ( o p t i o n s . a l l r u l e s . m a x C h e c k b o x . a l e r t T e x t 2 )  
 	 	 	 	 	   r e t u r n   o p t i o n s . a l l r u l e s . m a x C h e c k b o x . a l e r t T e x t   +   "   "   +   n b C h e c k   +   "   "   +   o p t i o n s . a l l r u l e s . m a x C h e c k b o x . a l e r t T e x t 2 ;  
 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s . m a x C h e c k b o x . a l e r t T e x t ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   M i n   n u m b e r   o f   c h e c k b o x   s e l e c t e d  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ m i n C h e c k b o x :   f u n c t i o n ( f o r m ,   f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
  
 	 	 	 v a r   n b C h e c k   =   r u l e s [ i   +   1 ] ;  
 	 	 	 v a r   g r o u p n a m e   =   f i e l d . a t t r ( " n a m e " ) ;  
 	 	 	 v a r   g r o u p S i z e   =   f o r m . f i n d ( " i n p u t [ n a m e = ' "   +   g r o u p n a m e   +   " ' ] : c h e c k e d " ) . s i z e ( ) ;  
 	 	 	 i f   ( g r o u p S i z e   <   n b C h e c k )   {  
 	 	 	 	 o p t i o n s . s h o w A r r o w   =   f a l s e ;  
 	 	 	 	 r e t u r n   o p t i o n s . a l l r u l e s . m i n C h e c k b o x . a l e r t T e x t   +   "   "   +   n b C h e c k   +   "   "   +   o p t i o n s . a l l r u l e s . m i n C h e c k b o x . a l e r t T e x t 2 ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C h e c k s   t h a t   i t   i s   a   v a l i d   c r e d i t   c a r d   n u m b e r   a c c o r d i n g   t o   t h e  
 	 	 *   L u h n   c h e c k s u m   a l g o r i t h m .  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ c r e d i t C a r d :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 / / s p a c e s   a n d   d a s h e s   m a y   b e   v a l i d   c h a r a c t e r s ,   b u t   m u s t   b e   s t r i p p e d   t o   c a l c u l a t e   t h e   c h e c k s u m .  
 	 	 	 v a r   v a l i d   =   f a l s e ,   c a r d N u m b e r   =   f i e l d . v a l ( ) . r e p l a c e ( /   + / g ,   ' ' ) . r e p l a c e ( / - + / g ,   ' ' ) ;  
  
 	 	 	 v a r   n u m D i g i t s   =   c a r d N u m b e r . l e n g t h ;  
 	 	 	 i f   ( n u m D i g i t s   > =   1 4   & &   n u m D i g i t s   < =   1 6   & &   p a r s e I n t ( c a r d N u m b e r )   >   0 )   {  
  
 	 	 	 	 v a r   s u m   =   0 ,   i   =   n u m D i g i t s   -   1 ,   p o s   =   1 ,   d i g i t ,   l u h n   =   n e w   S t r i n g ( ) ;  
 	 	 	 	 d o   {  
 	 	 	 	 	 d i g i t   =   p a r s e I n t ( c a r d N u m b e r . c h a r A t ( i ) ) ;  
 	 	 	 	 	 l u h n   + =   ( p o s + +   %   2   = =   0 )   ?   d i g i t   *   2   :   d i g i t ;  
 	 	 	 	 }   w h i l e   ( - - i   > =   0 )  
  
 	 	 	 	 f o r   ( i   =   0 ;   i   <   l u h n . l e n g t h ;   i + + )   {  
 	 	 	 	 	 s u m   + =   p a r s e I n t ( l u h n . c h a r A t ( i ) ) ;  
 	 	 	 	 }  
 	 	 	 	 v a l i d   =   s u m   %   1 0   = =   0 ;  
 	 	 	 }  
 	 	 	 i f   ( ! v a l i d )   r e t u r n   o p t i o n s . a l l r u l e s . c r e d i t C a r d . a l e r t T e x t ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   A j a x   f i e l d   v a l i d a t i o n  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   n o t h i n g !   t h e   a j a x   v a l i d a t o r   h a n d l e s   t h e   p r o m p t s   i t s e l f  
 	 	 * /  
 	 	   _ a j a x :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
  
 	 	 	   v a r   e r r o r S e l e c t o r   =   r u l e s [ i   +   1 ] ;  
 	 	 	   v a r   r u l e   =   o p t i o n s . a l l r u l e s [ e r r o r S e l e c t o r ] ;  
 	 	 	   v a r   e x t r a D a t a   =   r u l e . e x t r a D a t a ;  
 	 	 	   v a r   e x t r a D a t a D y n a m i c   =   r u l e . e x t r a D a t a D y n a m i c ;  
 	 	 	   v a r   d a t a   =   {  
 	 	 	 	 " f i e l d I d "   :   f i e l d . a t t r ( " i d " ) ,  
 	 	 	 	 " f i e l d V a l u e "   :   f i e l d . v a l ( )  
 	 	 	   } ;  
  
 	 	 	   i f   ( t y p e o f   e x t r a D a t a   = = =   " o b j e c t " )   {  
 	 	 	 	 $ . e x t e n d ( d a t a ,   e x t r a D a t a ) ;  
 	 	 	   }   e l s e   i f   ( t y p e o f   e x t r a D a t a   = = =   " s t r i n g " )   {  
 	 	 	 	 v a r   t e m p D a t a   =   e x t r a D a t a . s p l i t ( " & " ) ;  
 	 	 	 	 f o r ( v a r   i   =   0 ;   i   <   t e m p D a t a . l e n g t h ;   i + + )   {  
 	 	 	 	 	 v a r   v a l u e s   =   t e m p D a t a [ i ] . s p l i t ( " = " ) ;  
 	 	 	 	 	 i f   ( v a l u e s [ 0 ]   & &   v a l u e s [ 0 ] )   {  
 	 	 	 	 	 	 d a t a [ v a l u e s [ 0 ] ]   =   v a l u e s [ 1 ] ;  
 	 	 	 	 	 }  
 	 	 	 	 }  
 	 	 	   }  
  
 	 	 	   i f   ( e x t r a D a t a D y n a m i c )   {  
 	 	 	 	   v a r   t m p D a t a   =   [ ] ;  
 	 	 	 	   v a r   d o m I d s   =   S t r i n g ( e x t r a D a t a D y n a m i c ) . s p l i t ( " , " ) ;  
 	 	 	 	   f o r   ( v a r   i   =   0 ;   i   <   d o m I d s . l e n g t h ;   i + + )   {  
 	 	 	 	 	   v a r   i d   =   d o m I d s [ i ] ;  
 	 	 	 	 	   i f   ( $ ( i d ) . l e n g t h )   {  
 	 	 	 	 	 	   v a r   i n p u t V a l u e   =   f i e l d . c l o s e s t ( " f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r " ) . f i n d ( i d ) . v a l ( ) ;  
 	 	 	 	 	 	   v a r   k e y V a l u e   =   i d . r e p l a c e ( ' # ' ,   ' ' )   +   ' = '   +   e s c a p e ( i n p u t V a l u e ) ;  
 	 	 	 	 	 	   d a t a [ i d . r e p l a c e ( ' # ' ,   ' ' ) ]   =   i n p u t V a l u e ;  
 	 	 	 	 	   }  
 	 	 	 	   }  
 	 	 	   }  
 	 	 	    
 	 	 	   / /   I f   a   f i e l d   c h a n g e   e v e n t   t r i g g e r e d   t h i s   w e   w a n t   t o   c l e a r   t h e   c a c h e   f o r   t h i s   I D  
 	 	 	   i f   ( o p t i o n s . e v e n t T r i g g e r   = =   " f i e l d " )   {  
 	 	 	 	 d e l e t e ( o p t i o n s . a j a x V a l i d C a c h e [ f i e l d . a t t r ( " i d " ) ] ) ;  
 	 	 	   }  
  
 	 	 	   / /   I f   t h e r e   i s   a n   e r r o r   o r   i f   t h e   t h e   f i e l d   i s   a l r e a d y   v a l i d a t e d ,   d o   n o t   r e - e x e c u t e   A J A X  
 	 	 	   i f   ( ! o p t i o n s . i s E r r o r   & &   ! m e t h o d s . _ c h e c k A j a x F i e l d S t a t u s ( f i e l d . a t t r ( " i d " ) ,   o p t i o n s ) )   {  
 	 	 	 	   $ . a j a x ( {  
 	 	 	 	 	   t y p e :   o p t i o n s . a j a x F o r m V a l i d a t i o n M e t h o d ,  
 	 	 	 	 	   u r l :   r u l e . u r l ,  
 	 	 	 	 	   c a c h e :   f a l s e ,  
 	 	 	 	 	   d a t a T y p e :   " j s o n " ,  
 	 	 	 	 	   d a t a :   d a t a ,  
 	 	 	 	 	   f i e l d :   f i e l d ,  
 	 	 	 	 	   r u l e :   r u l e ,  
 	 	 	 	 	   m e t h o d s :   m e t h o d s ,  
 	 	 	 	 	   o p t i o n s :   o p t i o n s ,  
 	 	 	 	 	   b e f o r e S e n d :   f u n c t i o n ( )   { } ,  
 	 	 	 	 	   e r r o r :   f u n c t i o n ( d a t a ,   t r a n s p o r t )   {  
 	 	 	 	 	 	 i f   ( o p t i o n s . o n F a i l u r e )   {  
 	 	 	 	 	 	 	 o p t i o n s . o n F a i l u r e ( d a t a ,   t r a n s p o r t ) ;  
 	 	 	 	 	 	 }   e l s e   {  
 	 	 	 	 	 	 	 m e t h o d s . _ a j a x E r r o r ( d a t a ,   t r a n s p o r t ) ;  
 	 	 	 	 	 	 }  
 	 	 	 	 	   } ,  
 	 	 	 	 	   s u c c e s s :   f u n c t i o n ( j s o n )   {  
  
 	 	 	 	 	 	   / /   a s y n c h r o n o u s l y   c a l l e d   o n   s u c c e s s ,   d a t a   i s   t h e   j s o n   a n s w e r   f r o m   t h e   s e r v e r  
 	 	 	 	 	 	   v a r   e r r o r F i e l d I d   =   j s o n [ 0 ] ;  
 	 	 	 	 	 	   / / v a r   e r r o r F i e l d   =   $ ( $ ( " # "   +   e r r o r F i e l d I d ) [ 0 ] ) ;  
 	 	 	 	 	 	   v a r   e r r o r F i e l d   =   $ ( " # " +   e r r o r F i e l d I d ) . e q ( 0 ) ;  
  
 	 	 	 	 	 	   / /   m a k e   s u r e   w e   f o u n d   t h e   e l e m e n t  
 	 	 	 	 	 	   i f   ( e r r o r F i e l d . l e n g t h   = =   1 )   {  
 	 	 	 	 	 	 	   v a r   s t a t u s   =   j s o n [ 1 ] ;  
 	 	 	 	 	 	 	   / /   r e a d   t h e   o p t i o n a l   m s g   f r o m   t h e   s e r v e r  
 	 	 	 	 	 	 	   v a r   m s g   =   j s o n [ 2 ] ;  
 	 	 	 	 	 	 	   i f   ( ! s t a t u s )   {  
 	 	 	 	 	 	 	 	   / /   H o u s t o n   w e   g o t   a   p r o b l e m   -   d i s p l a y   a n   r e d   p r o m p t  
 	 	 	 	 	 	 	 	   o p t i o n s . a j a x V a l i d C a c h e [ e r r o r F i e l d I d ]   =   f a l s e ;  
 	 	 	 	 	 	 	 	   o p t i o n s . i s E r r o r   =   t r u e ;  
  
 	 	 	 	 	 	 	 	   / /   r e s o l v e   t h e   m s g   p r o m p t  
 	 	 	 	 	 	 	 	   i f ( m s g )   {  
 	 	 	 	 	 	 	 	 	   i f   ( o p t i o n s . a l l r u l e s [ m s g ] )   {  
 	 	 	 	 	 	 	 	 	 	   v a r   t x t   =   o p t i o n s . a l l r u l e s [ m s g ] . a l e r t T e x t ;  
 	 	 	 	 	 	 	 	 	 	   i f   ( t x t )   {  
 	 	 	 	 	 	 	 	 	 	 	 m s g   =   t x t ;  
 	 	 	 	 	 	 	 }  
 	 	 	 	 	 	 	 	 	   }  
 	 	 	 	 	 	 	 	   }  
 	 	 	 	 	 	 	 	   e l s e  
 	 	 	 	 	 	 	 	 	 m s g   =   r u l e . a l e r t T e x t ;  
  
 	 	 	 	 	 	 	 	   i f   ( o p t i o n s . s h o w P r o m p t s )   m e t h o d s . _ s h o w P r o m p t ( e r r o r F i e l d ,   m s g ,   " " ,   t r u e ,   o p t i o n s ) ;  
 	 	 	 	 	 	 	   }   e l s e   {  
 	 	 	 	 	 	 	 	   o p t i o n s . a j a x V a l i d C a c h e [ e r r o r F i e l d I d ]   =   t r u e ;  
  
 	 	 	 	 	 	 	 	   / /   r e s o l v e s   t h e   m s g   p r o m p t  
 	 	 	 	 	 	 	 	   i f ( m s g )   {  
 	 	 	 	 	 	 	 	 	   i f   ( o p t i o n s . a l l r u l e s [ m s g ] )   {  
 	 	 	 	 	 	 	 	 	 	   v a r   t x t   =   o p t i o n s . a l l r u l e s [ m s g ] . a l e r t T e x t O k ;  
 	 	 	 	 	 	 	 	 	 	   i f   ( t x t )   {  
 	 	 	 	 	 	 	 	 	 	 	 m s g   =   t x t ;  
 	 	 	 	 	 	 	 }  
 	 	 	 	 	 	 	 	 	   }  
 	 	 	 	 	 	 	 	   }  
 	 	 	 	 	 	 	 	   e l s e  
 	 	 	 	 	 	 	 	   m s g   =   r u l e . a l e r t T e x t O k ;  
  
 	 	 	 	 	 	 	 	   i f   ( o p t i o n s . s h o w P r o m p t s )   {  
 	 	 	 	 	 	 	 	 	   / /   s e e   i f   w e   s h o u l d   d i s p l a y   a   g r e e n   p r o m p t  
 	 	 	 	 	 	 	 	 	   i f   ( m s g )  
 	 	 	 	 	 	 	 	 	 	 m e t h o d s . _ s h o w P r o m p t ( e r r o r F i e l d ,   m s g ,   " p a s s " ,   t r u e ,   o p t i o n s ) ;  
 	 	 	 	 	 	 	 	 	   e l s e  
 	 	 	 	 	 	 	 	 	 	 m e t h o d s . _ c l o s e P r o m p t ( e r r o r F i e l d ) ;  
 	 	 	 	 	 	 	 	 }  
 	 	 	 	 	 	 	 	  
 	 	 	 	 	 	 	 	   / /   I f   a   s u b m i t   f o r m   t r i g g e r e d   t h i s ,   w e   w a n t   t o   r e - s u b m i t   t h e   f o r m  
 	 	 	 	 	 	 	 	   i f   ( o p t i o n s . e v e n t T r i g g e r   = =   " s u b m i t " )  
 	 	 	 	 	 	 	 	 	 f i e l d . c l o s e s t ( " f o r m " ) . s u b m i t ( ) ;  
 	 	 	 	 	 	 	   }  
 	 	 	 	 	 	   }  
 	 	 	 	 	 	   e r r o r F i e l d . t r i g g e r ( " j q v . f i e l d . r e s u l t " ,   [ e r r o r F i e l d ,   o p t i o n s . i s E r r o r ,   m s g ] ) ;  
 	 	 	 	 	   }  
 	 	 	 	   } ) ;  
 	 	 	 	    
 	 	 	 	   r e t u r n   r u l e . a l e r t T e x t L o a d ;  
 	 	 	   }  
 	 	   } ,  
 	 	 / * *  
 	 	 *   C o m m o n   m e t h o d   t o   h a n d l e   a j a x   e r r o r s  
 	 	 *  
 	 	 *   @ p a r a m   { O b j e c t }   d a t a  
 	 	 *   @ p a r a m   { O b j e c t }   t r a n s p o r t  
 	 	 * /  
 	 	 _ a j a x E r r o r :   f u n c t i o n ( d a t a ,   t r a n s p o r t )   {  
 	 	 	 i f ( d a t a . s t a t u s   = =   0   & &   t r a n s p o r t   = =   n u l l )  
 	 	 	 	 a l e r t ( " T h e   p a g e   i s   n o t   s e r v e d   f r o m   a   s e r v e r !   a j a x   c a l l   f a i l e d " ) ;  
 	 	 	 e l s e   i f ( t y p e o f   c o n s o l e   ! =   " u n d e f i n e d " )  
 	 	 	 	 c o n s o l e . l o g ( " A j a x   e r r o r :   "   +   d a t a . s t a t u s   +   "   "   +   t r a n s p o r t ) ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   d a t e   - >   s t r i n g  
 	 	 *  
 	 	 *   @ p a r a m   { O b j e c t }   d a t e  
 	 	 * /  
 	 	 _ d a t e T o S t r i n g :   f u n c t i o n ( d a t e )   {  
 	 	 	 r e t u r n   d a t e . g e t F u l l Y e a r ( ) + " - " + ( d a t e . g e t M o n t h ( ) + 1 ) + " - " + d a t e . g e t D a t e ( ) ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   P a r s e s   a n   I S O   d a t e  
 	 	 *   @ p a r a m   { S t r i n g }   d  
 	 	 * /  
 	 	 _ p a r s e D a t e :   f u n c t i o n ( d )   {  
  
 	 	 	 v a r   d a t e P a r t s   =   d . s p l i t ( " - " ) ;  
 	 	 	 i f ( d a t e P a r t s = = d )  
 	 	 	 	 d a t e P a r t s   =   d . s p l i t ( " / " ) ;  
 	 	 	 i f ( d a t e P a r t s = = d )   {  
 	 	 	 	 d a t e P a r t s   =   d . s p l i t ( " . " ) ;  
 	 	 	 	 r e t u r n   n e w   D a t e ( d a t e P a r t s [ 2 ] ,   ( d a t e P a r t s [ 1 ]   -   1 ) ,   d a t e P a r t s [ 0 ] ) ;  
 	 	 	 }  
 	 	 	 r e t u r n   n e w   D a t e ( d a t e P a r t s [ 0 ] ,   ( d a t e P a r t s [ 1 ]   -   1 )   , d a t e P a r t s [ 2 ] ) ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   B u i l d s   o r   u p d a t e s   a   p r o m p t   w i t h   t h e   g i v e n   i n f o r m a t i o n  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { S t r i n g }   p r o m p t T e x t   h t m l   t e x t   t o   d i s p l a y   t y p e  
 	 	 *   @ p a r a m   { S t r i n g }   t y p e   t h e   t y p e   o f   b u b b l e :   ' p a s s '   ( g r e e n ) ,   ' l o a d '   ( b l a c k )   a n y t h i n g   e l s e   ( r e d )  
 	 	 *   @ p a r a m   { b o o l e a n }   a j a x e d   -   u s e   t o   m a r k   f i e l d s   t h a n   b e i n g   v a l i d a t e d   w i t h   a j a x  
 	 	 *   @ p a r a m   { M a p }   o p t i o n s   u s e r   o p t i o n s  
 	 	 * /  
 	 	   _ s h o w P r o m p t :   f u n c t i o n ( f i e l d ,   p r o m p t T e x t ,   t y p e ,   a j a x e d ,   o p t i o n s ,   a j a x f o r m )   {  
 	 	   	 / / C h e c k   i f   w e   n e e d   t o   a d j u s t   w h a t   e l e m e n t   t o   s h o w   t h e   p r o m p t   o n  
 	 	 	 i f ( f i e l d . d a t a ( ' j q v - p r o m p t - a t ' )   i n s t a n c e o f   j Q u e r y   ) {  
 	 	 	 	 f i e l d   =   f i e l d . d a t a ( ' j q v - p r o m p t - a t ' ) ;  
 	 	 	 }   e l s e   i f ( f i e l d . d a t a ( ' j q v - p r o m p t - a t ' ) )   {  
 	 	 	 	 f i e l d   =   $ ( f i e l d . d a t a ( ' j q v - p r o m p t - a t ' ) ) ;  
 	 	 	 }  
  
 	 	 	   v a r   p r o m p t   =   m e t h o d s . _ g e t P r o m p t ( f i e l d ) ;  
 	 	 	   / /   T h e   a j a x   s u b m i t   e r r o r s   a r e   n o t   s e e   h a s   a n   e r r o r   i n   t h e   f o r m ,  
 	 	 	   / /   W h e n   t h e   f o r m   e r r o r s   a r e   r e t u r n e d ,   t h e   e n g i n e   s e e   2   b u b b l e s ,   b u t   t h o s e   a r e   e b i n g   c l o s e d   b y   t h e   e n g i n e   a t   t h e   s a m e   t i m e  
 	 	 	   / /   B e c a u s e   n o   e r r o r   w a s   f o u n d   b e f o r   s u b m i t t i n g  
 	 	 	   i f ( a j a x f o r m )   p r o m p t   =   f a l s e ;  
 	 	 	   / /   C h e c k   t h a t   t h e r e   i s   i n d d e d   t e x t  
 	 	 	   i f ( $ . t r i m ( p r o m p t T e x t ) ) {    
 	 	 	 	   i f   ( p r o m p t )  
 	 	 	 	 	 m e t h o d s . _ u p d a t e P r o m p t ( f i e l d ,   p r o m p t ,   p r o m p t T e x t ,   t y p e ,   a j a x e d ,   o p t i o n s ) ;  
 	 	 	 	   e l s e  
 	 	 	 	 	 m e t h o d s . _ b u i l d P r o m p t ( f i e l d ,   p r o m p t T e x t ,   t y p e ,   a j a x e d ,   o p t i o n s ) ;  
 	 	 	 }  
 	 	   } ,  
 	 	 / * *  
 	 	 *   B u i l d s   a n d   s h a d e s   a   p r o m p t   f o r   t h e   g i v e n   f i e l d .  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { S t r i n g }   p r o m p t T e x t   h t m l   t e x t   t o   d i s p l a y   t y p e  
 	 	 *   @ p a r a m   { S t r i n g }   t y p e   t h e   t y p e   o f   b u b b l e :   ' p a s s '   ( g r e e n ) ,   ' l o a d '   ( b l a c k )   a n y t h i n g   e l s e   ( r e d )  
 	 	 *   @ p a r a m   { b o o l e a n }   a j a x e d   -   u s e   t o   m a r k   f i e l d s   t h a n   b e i n g   v a l i d a t e d   w i t h   a j a x  
 	 	 *   @ p a r a m   { M a p }   o p t i o n s   u s e r   o p t i o n s  
 	 	 * /  
 	 	 _ b u i l d P r o m p t :   f u n c t i o n ( f i e l d ,   p r o m p t T e x t ,   t y p e ,   a j a x e d ,   o p t i o n s )   {  
  
 	 	 	 / /   c r e a t e   t h e   p r o m p t  
 	 	 	 v a r   p r o m p t   =   $ ( ' < d i v > ' ) ;  
 	 	 	 p r o m p t . a d d C l a s s ( m e t h o d s . _ g e t C l a s s N a m e ( f i e l d . a t t r ( " i d " ) )   +   " f o r m E r r o r " ) ;  
 	 	 	 / /   a d d   a   c l a s s   n a m e   t o   i d e n t i f y   t h e   p a r e n t   f o r m   o f   t h e   p r o m p t  
 	 	 	 p r o m p t . a d d C l a s s ( " p a r e n t F o r m " + m e t h o d s . _ g e t C l a s s N a m e ( f i e l d . c l o s e s t ( ' f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r ' ) . a t t r ( " i d " ) ) ) ;  
 	 	 	 p r o m p t . a d d C l a s s ( " f o r m E r r o r " ) ;  
  
 	 	 	 s w i t c h   ( t y p e )   {  
 	 	 	 	 c a s e   " p a s s " :  
 	 	 	 	 	 p r o m p t . a d d C l a s s ( " g r e e n P o p u p " ) ;  
 	 	 	 	 	 b r e a k ;  
 	 	 	 	 c a s e   " l o a d " :  
 	 	 	 	 	 p r o m p t . a d d C l a s s ( " b l a c k P o p u p " ) ;  
 	 	 	 	 	 b r e a k ;  
 	 	 	 	 d e f a u l t :  
 	 	 	 	 	 / *   i t   h a s   e r r o r     * /  
 	 	 	 	 	 / / a l e r t ( " u n k n o w n   p o p u p   t y p e : " + t y p e ) ;  
 	 	 	 }  
 	 	 	 i f   ( a j a x e d )  
 	 	 	 	 p r o m p t . a d d C l a s s ( " a j a x e d " ) ;  
  
 	 	 	 / /   c r e a t e   t h e   p r o m p t   c o n t e n t  
 	 	 	 v a r   p r o m p t C o n t e n t   =   $ ( ' < d i v > ' ) . a d d C l a s s ( " f o r m E r r o r C o n t e n t " ) . h t m l ( p r o m p t T e x t ) . a p p e n d T o ( p r o m p t ) ;  
  
 	 	 	 / /   d e t e r m i n e   p o s i t i o n   t y p e  
 	 	 	 v a r   p o s i t i o n T y p e = f i e l d . d a t a ( " p r o m p t P o s i t i o n " )   | |   o p t i o n s . p r o m p t P o s i t i o n ;  
  
 	 	 	 / /   c r e a t e   t h e   c s s   a r r o w   p o i n t i n g   a t   t h e   f i e l d  
 	 	 	 / /   n o t e   t h a t   t h e r e   i s   n o   t r i a n g l e   o n   m a x - c h e c k b o x   a n d   r a d i o  
 	 	 	 i f   ( o p t i o n s . s h o w A r r o w )   {  
 	 	 	 	 v a r   a r r o w   =   $ ( ' < d i v > ' ) . a d d C l a s s ( " f o r m E r r o r A r r o w " ) ;  
  
 	 	 	 	 / / p r o m p t   p o s i t i o n i n g   a d j u s t m e n t   s u p p o r t .   U s a g e :   p o s i t i o n T y p e : X s h i f t , Y s h i f t   ( f o r   e x . :   b o t t o m L e f t : + 2 0   o r   b o t t o m L e f t : - 2 0 , + 1 0 )  
 	 	 	 	 i f   ( t y p e o f ( p o s i t i o n T y p e ) = = ' s t r i n g ' )    
 	 	 	 	 {  
 	 	 	 	 	 v a r   p o s = p o s i t i o n T y p e . i n d e x O f ( " : " ) ;  
 	 	 	 	 	 i f ( p o s ! = - 1 )  
 	 	 	 	 	 	 p o s i t i o n T y p e = p o s i t i o n T y p e . s u b s t r i n g ( 0 , p o s ) ;  
 	 	 	 	 }  
  
 	 	 	 	 s w i t c h   ( p o s i t i o n T y p e )   {  
 	 	 	 	 	 c a s e   " b o t t o m L e f t " :  
 	 	 	 	 	 c a s e   " b o t t o m R i g h t " :  
 	 	 	 	 	 	 p r o m p t . f i n d ( " . f o r m E r r o r C o n t e n t " ) . b e f o r e ( a r r o w ) ;  
 	 	 	 	 	 	 a r r o w . a d d C l a s s ( " f o r m E r r o r A r r o w B o t t o m " ) . h t m l ( ' < d i v   c l a s s = " l i n e 1 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 2 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 3 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 4 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 5 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 6 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 7 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 8 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 9 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 1 0 " > < ! - -   - - > < / d i v > ' ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 	 c a s e   " t o p L e f t " :  
 	 	 	 	 	 c a s e   " t o p R i g h t " :  
 	 	 	 	 	 	 a r r o w . h t m l ( ' < d i v   c l a s s = " l i n e 1 0 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 9 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 8 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 7 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 6 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 5 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 4 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 3 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 2 " > < ! - -   - - > < / d i v > < d i v   c l a s s = " l i n e 1 " > < ! - -   - - > < / d i v > ' ) ;  
 	 	 	 	 	 	 p r o m p t . a p p e n d ( a r r o w ) ;  
 	 	 	 	 	 	 b r e a k ;  
 	 	 	 	 }  
 	 	 	 }  
 	 	 	 / /   A d d   c u s t o m   p r o m p t   c l a s s  
 	 	 	 i f   ( o p t i o n s . a d d P r o m p t C l a s s )  
 	 	 	 	 p r o m p t . a d d C l a s s ( o p t i o n s . a d d P r o m p t C l a s s ) ;  
  
                         / /   A d d   c u s t o m   p r o m p t   c l a s s   d e f i n e d   i n   e l e m e n t  
                         v a r   r e q u i r e d O v e r r i d e   =   f i e l d . a t t r ( ' d a t a - r e q u i r e d - c l a s s ' ) ;  
                         i f ( r e q u i r e d O v e r r i d e   ! = =   u n d e f i n e d )   {  
                                 p r o m p t . a d d C l a s s ( r e q u i r e d O v e r r i d e ) ;  
                         }   e l s e   {  
                                 i f ( o p t i o n s . p r e t t y S e l e c t )   {  
                                         i f ( $ ( ' # '   +   f i e l d . a t t r ( ' i d ' ) ) . n e x t ( ) . i s ( ' s e l e c t ' ) )   {  
                                                 v a r   p r e t t y O v e r r i d e C l a s s   =   $ ( ' # '   +   f i e l d . a t t r ( ' i d ' ) . s u b s t r ( o p t i o n s . u s e P r e f i x . l e n g t h ) . s u b s t r i n g ( o p t i o n s . u s e S u f f i x . l e n g t h ) ) . a t t r ( ' d a t a - r e q u i r e d - c l a s s ' ) ;  
                                                 i f ( p r e t t y O v e r r i d e C l a s s   ! = =   u n d e f i n e d )   {  
                                                         p r o m p t . a d d C l a s s ( p r e t t y O v e r r i d e C l a s s ) ;  
                                                 }  
                                         }  
                                 }  
                         }  
  
 	 	 	 p r o m p t . c s s ( {  
 	 	 	 	 " o p a c i t y " :   0  
 	 	 	 } ) ;  
 	 	 	 i f ( p o s i t i o n T y p e   = = =   ' i n l i n e ' )   {  
 	 	 	 	 p r o m p t . a d d C l a s s ( " i n l i n e " ) ;  
 	 	 	 	 i f ( t y p e o f   f i e l d . a t t r ( ' d a t a - p r o m p t - t a r g e t ' )   ! = =   ' u n d e f i n e d '   & &   $ ( ' # ' + f i e l d . a t t r ( ' d a t a - p r o m p t - t a r g e t ' ) ) . l e n g t h   >   0 )   {  
 	 	 	 	 	 p r o m p t . a p p e n d T o ( $ ( ' # ' + f i e l d . a t t r ( ' d a t a - p r o m p t - t a r g e t ' ) ) ) ;  
 	 	 	 	 }   e l s e   {  
 	 	 	 	 	 f i e l d . a f t e r ( p r o m p t ) ;  
 	 	 	 	 }  
 	 	 	 }   e l s e   {  
 	 	 	 	 f i e l d . b e f o r e ( p r o m p t ) ; 	 	 	 	  
 	 	 	 }  
 	 	 	  
 	 	 	 v a r   p o s   =   m e t h o d s . _ c a l c u l a t e P o s i t i o n ( f i e l d ,   p r o m p t ,   o p t i o n s ) ;  
 	 	 	 p r o m p t . c s s ( {  
 	 	 	 	 ' p o s i t i o n ' :   p o s i t i o n T y p e   = = =   ' i n l i n e '   ?   ' r e l a t i v e '   :   ' a b s o l u t e ' ,  
 	 	 	 	 " t o p " :   p o s . c a l l e r T o p P o s i t i o n ,  
 	 	 	 	 " l e f t " :   p o s . c a l l e r l e f t P o s i t i o n ,  
 	 	 	 	 " m a r g i n T o p " :   p o s . m a r g i n T o p S i z e ,  
 	 	 	 	 " o p a c i t y " :   0  
 	 	 	 } ) . d a t a ( " c a l l e r F i e l d " ,   f i e l d ) ;  
 	 	 	  
  
 	 	 	 i f   ( o p t i o n s . a u t o H i d e P r o m p t )   {  
 	 	 	 	 s e t T i m e o u t ( f u n c t i o n ( ) {  
 	 	 	 	 	 p r o m p t . a n i m a t e ( {  
 	 	 	 	 	 	 " o p a c i t y " :   0  
 	 	 	 	 	 } , f u n c t i o n ( ) {  
 	 	 	 	 	 	 p r o m p t . c l o s e s t ( ' . f o r m E r r o r O u t e r ' ) . r e m o v e ( ) ;  
 	 	 	 	 	 	 p r o m p t . r e m o v e ( ) ;  
 	 	 	 	 	 } ) ;  
 	 	 	 	 } ,   o p t i o n s . a u t o H i d e D e l a y ) ;  
 	 	 	 }    
 	 	 	 r e t u r n   p r o m p t . a n i m a t e ( {  
 	 	 	 	 " o p a c i t y " :   0 . 8 7  
 	 	 	 } ) ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   U p d a t e s   t h e   p r o m p t   t e x t   f i e l d   -   t h e   f i e l d   f o r   w h i c h   t h e   p r o m p t  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { S t r i n g }   p r o m p t T e x t   h t m l   t e x t   t o   d i s p l a y   t y p e  
 	 	 *   @ p a r a m   { S t r i n g }   t y p e   t h e   t y p e   o f   b u b b l e :   ' p a s s '   ( g r e e n ) ,   ' l o a d '   ( b l a c k )   a n y t h i n g   e l s e   ( r e d )  
 	 	 *   @ p a r a m   { b o o l e a n }   a j a x e d   -   u s e   t o   m a r k   f i e l d s   t h a n   b e i n g   v a l i d a t e d   w i t h   a j a x  
 	 	 *   @ p a r a m   { M a p }   o p t i o n s   u s e r   o p t i o n s  
 	 	 * /  
 	 	 _ u p d a t e P r o m p t :   f u n c t i o n ( f i e l d ,   p r o m p t ,   p r o m p t T e x t ,   t y p e ,   a j a x e d ,   o p t i o n s ,   n o A n i m a t i o n )   {  
  
 	 	 	 i f   ( p r o m p t )   {  
 	 	 	 	 i f   ( t y p e o f   t y p e   ! = =   " u n d e f i n e d " )   {  
 	 	 	 	 	 i f   ( t y p e   = =   " p a s s " )  
 	 	 	 	 	 	 p r o m p t . a d d C l a s s ( " g r e e n P o p u p " ) ;  
 	 	 	 	 	 e l s e  
 	 	 	 	 	 	 p r o m p t . r e m o v e C l a s s ( " g r e e n P o p u p " ) ;  
  
 	 	 	 	 	 i f   ( t y p e   = =   " l o a d " )  
 	 	 	 	 	 	 p r o m p t . a d d C l a s s ( " b l a c k P o p u p " ) ;  
 	 	 	 	 	 e l s e  
 	 	 	 	 	 	 p r o m p t . r e m o v e C l a s s ( " b l a c k P o p u p " ) ;  
 	 	 	 	 }  
 	 	 	 	 i f   ( a j a x e d )  
 	 	 	 	 	 p r o m p t . a d d C l a s s ( " a j a x e d " ) ;  
 	 	 	 	 e l s e  
 	 	 	 	 	 p r o m p t . r e m o v e C l a s s ( " a j a x e d " ) ;  
  
 	 	 	 	 p r o m p t . f i n d ( " . f o r m E r r o r C o n t e n t " ) . h t m l ( p r o m p t T e x t ) ;  
  
 	 	 	 	 v a r   p o s   =   m e t h o d s . _ c a l c u l a t e P o s i t i o n ( f i e l d ,   p r o m p t ,   o p t i o n s ) ;  
 	 	 	 	 v a r   c s s   =   { " t o p " :   p o s . c a l l e r T o p P o s i t i o n ,  
 	 	 	 	 " l e f t " :   p o s . c a l l e r l e f t P o s i t i o n ,  
 	 	 	 	 " m a r g i n T o p " :   p o s . m a r g i n T o p S i z e } ;  
  
 	 	 	 	 i f   ( n o A n i m a t i o n )  
 	 	 	 	 	 p r o m p t . c s s ( c s s ) ;  
 	 	 	 	 e l s e  
 	 	 	 	 	 p r o m p t . a n i m a t e ( c s s ) ;  
 	 	 	 }  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C l o s e s   t h e   p r o m p t   a s s o c i a t e d   w i t h   t h e   g i v e n   f i e l d  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }  
 	 	 *                         f i e l d  
 	 	 * /  
 	 	   _ c l o s e P r o m p t :   f u n c t i o n ( f i e l d )   {  
 	 	 	   v a r   p r o m p t   =   m e t h o d s . _ g e t P r o m p t ( f i e l d ) ;  
 	 	 	   i f   ( p r o m p t )  
 	 	 	 	   p r o m p t . f a d e T o ( " f a s t " ,   0 ,   f u n c t i o n ( )   {  
 	 	 	 	 	   p r o m p t . p a r e n t ( ' . f o r m E r r o r O u t e r ' ) . r e m o v e ( ) ;  
 	 	 	 	 	   p r o m p t . r e m o v e ( ) ;  
 	 	 	 	   } ) ;  
 	 	   } ,  
 	 	   c l o s e P r o m p t :   f u n c t i o n ( f i e l d )   {  
 	 	 	   r e t u r n   m e t h o d s . _ c l o s e P r o m p t ( f i e l d ) ;  
 	 	   } ,  
 	 	 / * *  
 	 	 *   R e t u r n s   t h e   e r r o r   p r o m p t   m a t c h i n g   t h e   f i e l d   i f   a n y  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }  
 	 	 *                         f i e l d  
 	 	 *   @ r e t u r n   u n d e f i n e d   o r   t h e   e r r o r   p r o m p t   ( j q O b j e c t )  
 	 	 * /  
 	 	 _ g e t P r o m p t :   f u n c t i o n ( f i e l d )   {  
 	 	 	 	 v a r   f o r m I d   =   $ ( f i e l d ) . c l o s e s t ( ' f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r ' ) . a t t r ( ' i d ' ) ;  
 	 	 	 v a r   c l a s s N a m e   =   m e t h o d s . _ g e t C l a s s N a m e ( f i e l d . a t t r ( " i d " ) )   +   " f o r m E r r o r " ;  
 	 	 	 	 v a r   m a t c h   =   $ ( " . "   +   m e t h o d s . _ e s c a p e E x p r e s s i o n ( c l a s s N a m e )   +   ' . p a r e n t F o r m '   +   m e t h o d s . _ g e t C l a s s N a m e ( f o r m I d ) ) [ 0 ] ;  
 	 	 	 i f   ( m a t c h )  
 	 	 	 r e t u r n   $ ( m a t c h ) ;  
 	 	 } ,  
 	 	 / * *  
 	 	     *   R e t u r n s   t h e   e s c a p a d e   c l a s s n a m e  
 	 	     *  
 	 	     *   @ p a r a m   { s e l e c t o r }  
 	 	     *                         c l a s s N a m e  
 	 	     * /  
 	 	     _ e s c a p e E x p r e s s i o n :   f u n c t i o n   ( s e l e c t o r )   {  
 	 	 	     r e t u r n   s e l e c t o r . r e p l a c e ( / ( [ # ; & , \ . \ + \ * \ ~ ' : " \ ! \ ^ $ \ [ \ ] \ ( \ ) = > \ | ] ) / g ,   " \ \ $ 1 " ) ;  
 	 	     } ,  
 	 	 / * *  
 	 	   *   r e t u r n s   t r u e   i f   w e   a r e   i n   a   R T L e d   d o c u m e n t  
 	 	   *  
 	 	   *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	   * /  
 	 	 i s R T L :   f u n c t i o n ( f i e l d )  
 	 	 {  
 	 	 	 v a r   $ d o c u m e n t   =   $ ( d o c u m e n t ) ;  
 	 	 	 v a r   $ b o d y   =   $ ( ' b o d y ' ) ;  
 	 	 	 v a r   r t l   =  
 	 	 	 	 ( f i e l d   & &   f i e l d . h a s C l a s s ( ' r t l ' ) )   | |  
 	 	 	 	 ( f i e l d   & &   ( f i e l d . a t t r ( ' d i r ' )   | |   ' ' ) . t o L o w e r C a s e ( ) = = = ' r t l ' )   | |  
 	 	 	 	 $ d o c u m e n t . h a s C l a s s ( ' r t l ' )   | |  
 	 	 	 	 ( $ d o c u m e n t . a t t r ( ' d i r ' )   | |   ' ' ) . t o L o w e r C a s e ( ) = = = ' r t l '   | |  
 	 	 	 	 $ b o d y . h a s C l a s s ( ' r t l ' )   | |  
 	 	 	 	 ( $ b o d y . a t t r ( ' d i r ' )   | |   ' ' ) . t o L o w e r C a s e ( ) = = = ' r t l ' ;  
 	 	 	 r e t u r n   B o o l e a n ( r t l ) ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C a l c u l a t e s   p r o m p t   p o s i t i o n  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }  
 	 	 *                         f i e l d  
 	 	 *   @ p a r a m   { j q O b j e c t }  
 	 	 *                         t h e   p r o m p t  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         o p t i o n s  
 	 	 *   @ r e t u r n   p o s i t i o n s  
 	 	 * /  
 	 	 _ c a l c u l a t e P o s i t i o n :   f u n c t i o n   ( f i e l d ,   p r o m p t E l m t ,   o p t i o n s )   {  
  
 	 	 	 v a r   p r o m p t T o p P o s i t i o n ,   p r o m p t l e f t P o s i t i o n ,   m a r g i n T o p S i z e ;  
 	 	 	 v a r   f i e l d W i d t h   	 =   f i e l d . w i d t h ( ) ;  
 	 	 	 v a r   f i e l d L e f t   	 =   f i e l d . p o s i t i o n ( ) . l e f t ;    
 	 	 	 v a r   f i e l d T o p   	 =     f i e l d . p o s i t i o n ( ) . t o p ;  
 	 	 	 v a r   f i e l d H e i g h t   	 =     f i e l d . h e i g h t ( ) ; 	  
 	 	 	 v a r   p r o m p t H e i g h t   =   p r o m p t E l m t . h e i g h t ( ) ;  
  
  
 	 	 	 / /   i s   t h e   f o r m   c o n t a i n e d   i n   a n   o v e r f l o w n   c o n t a i n e r ?  
 	 	 	 p r o m p t T o p P o s i t i o n   =   p r o m p t l e f t P o s i t i o n   =   0 ;  
 	 	 	 / /   c o m p e n s a t i o n   f o r   t h e   a r r o w  
 	 	 	 m a r g i n T o p S i z e   =   - p r o m p t H e i g h t ;  
 	 	  
  
 	 	 	 / / p r o m p t   p o s i t i o n i n g   a d j u s t m e n t   s u p p o r t  
 	 	 	 / / n o w   y o u   c a n   a d j u s t   p r o m p t   p o s i t i o n  
 	 	 	 / / u s a g e :   p o s i t i o n T y p e : X s h i f t , Y s h i f t  
 	 	 	 / / f o r   e x a m p l e :  
 	 	 	 / /       b o t t o m L e f t : + 2 0   m e a n s   b o t t o m L e f t   p o s i t i o n   s h i f t e d   b y   2 0   p i x e l s   r i g h t   h o r i z o n t a l l y  
 	 	 	 / /       t o p R i g h t : 2 0 ,   - 1 5   m e a n s   t o p R i g h t   p o s i t i o n   s h i f t e d   b y   2 0   p i x e l s   t o   r i g h t   a n d   1 5   p i x e l s   t o   t o p  
 	 	 	 / / Y o u   c a n   u s e   + p i x e l s ,   -   p i x e l s .   I f   n o   s i g n   i s   p r o v i d e d   t h a n   +   i s   d e f a u l t .  
 	 	 	 v a r   p o s i t i o n T y p e = f i e l d . d a t a ( " p r o m p t P o s i t i o n " )   | |   o p t i o n s . p r o m p t P o s i t i o n ;  
 	 	 	 v a r   s h i f t 1 = " " ;  
 	 	 	 v a r   s h i f t 2 = " " ;  
 	 	 	 v a r   s h i f t X = 0 ;  
 	 	 	 v a r   s h i f t Y = 0 ;  
 	 	 	 i f   ( t y p e o f ( p o s i t i o n T y p e ) = = ' s t r i n g ' )   {  
 	 	 	 	 / / d o   w e   h a v e   a n y   p o s i t i o n   a d j u s t m e n t s   ?  
 	 	 	 	 i f   ( p o s i t i o n T y p e . i n d e x O f ( " : " ) ! = - 1 )   {  
 	 	 	 	 	 s h i f t 1 = p o s i t i o n T y p e . s u b s t r i n g ( p o s i t i o n T y p e . i n d e x O f ( " : " ) + 1 ) ;  
 	 	 	 	 	 p o s i t i o n T y p e = p o s i t i o n T y p e . s u b s t r i n g ( 0 , p o s i t i o n T y p e . i n d e x O f ( " : " ) ) ;  
  
 	 	 	 	 	 / / i f   a n y   a d v a n c e d   p o s i t i o n i n g   w i l l   b e   n e e d e d   ( p e r c e n t s   o r   s o m e t h i n g   e l s e )   -   p a r s e r   s h o u l d   b e   a d d e d   h e r e  
 	 	 	 	 	 / / f o r   n o w   w e   u s e   s i m p l e   p a r s e I n t ( )  
  
 	 	 	 	 	 / / d o   w e   h a v e   s e c o n d   p a r a m e t e r ?  
 	 	 	 	 	 i f   ( s h i f t 1 . i n d e x O f ( " , " )   ! = - 1 )   {  
 	 	 	 	 	 	 s h i f t 2 = s h i f t 1 . s u b s t r i n g ( s h i f t 1 . i n d e x O f ( " , " )   + 1 ) ;  
 	 	 	 	 	 	 s h i f t 1 = s h i f t 1 . s u b s t r i n g ( 0 , s h i f t 1 . i n d e x O f ( " , " ) ) ;  
 	 	 	 	 	 	 s h i f t Y = p a r s e I n t ( s h i f t 2 ) ;  
 	 	 	 	 	 	 i f   ( i s N a N ( s h i f t Y ) )   s h i f t Y = 0 ;  
 	 	 	 	 	 } ;  
  
 	 	 	 	 	 s h i f t X = p a r s e I n t ( s h i f t 1 ) ;  
 	 	 	 	 	 i f   ( i s N a N ( s h i f t 1 ) )   s h i f t 1 = 0 ;  
  
 	 	 	 	 } ;  
 	 	 	 } ;  
  
 	 	 	  
 	 	 	 s w i t c h   ( p o s i t i o n T y p e )   {  
 	 	 	 	 d e f a u l t :  
 	 	 	 	 c a s e   " t o p R i g h t " :  
 	 	 	 	 	 p r o m p t l e f t P o s i t i o n   + =     f i e l d L e f t   +   f i e l d W i d t h   -   3 0 ;  
 	 	 	 	 	 p r o m p t T o p P o s i t i o n   + =     f i e l d T o p ;  
 	 	 	 	 	 b r e a k ;  
  
 	 	 	 	 c a s e   " t o p L e f t " :  
 	 	 	 	 	 p r o m p t T o p P o s i t i o n   + =     f i e l d T o p ;  
 	 	 	 	 	 p r o m p t l e f t P o s i t i o n   + =   f i e l d L e f t ;    
 	 	 	 	 	 b r e a k ;  
  
 	 	 	 	 c a s e   " c e n t e r R i g h t " :  
 	 	 	 	 	 p r o m p t T o p P o s i t i o n   =   f i e l d T o p + 4 ;  
 	 	 	 	 	 m a r g i n T o p S i z e   =   0 ;  
 	 	 	 	 	 p r o m p t l e f t P o s i t i o n =   f i e l d L e f t   +   f i e l d . o u t e r W i d t h ( t r u e ) + 5 ;  
 	 	 	 	 	 b r e a k ;  
 	 	 	 	 c a s e   " c e n t e r L e f t " :  
 	 	 	 	 	 p r o m p t l e f t P o s i t i o n   =   f i e l d L e f t   -   ( p r o m p t E l m t . w i d t h ( )   +   2 ) ;  
 	 	 	 	 	 p r o m p t T o p P o s i t i o n   =   f i e l d T o p + 4 ;  
 	 	 	 	 	 m a r g i n T o p S i z e   =   0 ;  
 	 	 	 	 	  
 	 	 	 	 	 b r e a k ;  
  
 	 	 	 	 c a s e   " b o t t o m L e f t " :  
 	 	 	 	 	 p r o m p t T o p P o s i t i o n   =   f i e l d T o p   +   f i e l d . h e i g h t ( )   +   5 ;  
 	 	 	 	 	 m a r g i n T o p S i z e   =   0 ;  
 	 	 	 	 	 p r o m p t l e f t P o s i t i o n   =   f i e l d L e f t ;  
 	 	 	 	 	 b r e a k ;  
 	 	 	 	 c a s e   " b o t t o m R i g h t " :  
 	 	 	 	 	 p r o m p t l e f t P o s i t i o n   =   f i e l d L e f t   +   f i e l d W i d t h   -   3 0 ;  
 	 	 	 	 	 p r o m p t T o p P o s i t i o n   =     f i e l d T o p   +     f i e l d . h e i g h t ( )   +   5 ;  
 	 	 	 	 	 m a r g i n T o p S i z e   =   0 ;  
 	 	 	 	 	 b r e a k ;  
 	 	 	 	 c a s e   " i n l i n e " :  
 	 	 	 	 	 p r o m p t l e f t P o s i t i o n   =   0 ;  
 	 	 	 	 	 p r o m p t T o p P o s i t i o n   =   0 ;  
 	 	 	 	 	 m a r g i n T o p S i z e   =   0 ;  
 	 	 	 } ;  
  
 	 	  
  
 	 	 	 / / a p p l y   a d j u s m e n t s   i f   a n y  
 	 	 	 p r o m p t l e f t P o s i t i o n   + =   s h i f t X ;  
 	 	 	 p r o m p t T o p P o s i t i o n     + =   s h i f t Y ;  
  
 	 	 	 r e t u r n   {  
 	 	 	 	 " c a l l e r T o p P o s i t i o n " :   p r o m p t T o p P o s i t i o n   +   " p x " ,  
 	 	 	 	 " c a l l e r l e f t P o s i t i o n " :   p r o m p t l e f t P o s i t i o n   +   " p x " ,  
 	 	 	 	 " m a r g i n T o p S i z e " :   m a r g i n T o p S i z e   +   " p x "  
 	 	 	 } ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   S a v e s   t h e   u s e r   o p t i o n s   a n d   v a r i a b l e s   i n   t h e   f o r m . d a t a  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }  
 	 	 *                         f o r m   -   t h e   f o r m   w h e r e   t h e   u s e r   o p t i o n   s h o u l d   b e   s a v e d  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *                         o p t i o n s   -   t h e   u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   t h e   u s e r   o p t i o n s   ( e x t e n d e d   f r o m   t h e   d e f a u l t s )  
 	 	 * /  
 	 	   _ s a v e O p t i o n s :   f u n c t i o n ( f o r m ,   o p t i o n s )   {  
  
 	 	 	   / /   i s   t h e r e   a   l a n g u a g e   l o c a l i s a t i o n   ?  
 	 	 	   i f   ( $ . v a l i d a t i o n E n g i n e L a n g u a g e )  
 	 	 	   v a r   a l l R u l e s   =   $ . v a l i d a t i o n E n g i n e L a n g u a g e . a l l R u l e s ;  
 	 	 	   e l s e  
 	 	 	   $ . e r r o r ( " j Q u e r y . v a l i d a t i o n E n g i n e   r u l e s   a r e   n o t   l o a d e d ,   p l z   a d d   l o c a l i z a t i o n   f i l e s   t o   t h e   p a g e " ) ;  
 	 	 	   / /   - - -   I n t e r n a l s   D O   N O T   T O U C H   o r   O V E R L O A D   - - -  
 	 	 	   / /   v a l i d a t i o n   r u l e s   a n d   i 1 8  
 	 	 	   $ . v a l i d a t i o n E n g i n e . d e f a u l t s . a l l r u l e s   =   a l l R u l e s ;  
  
 	 	 	   v a r   u s e r O p t i o n s   =   $ . e x t e n d ( t r u e , { } , $ . v a l i d a t i o n E n g i n e . d e f a u l t s , o p t i o n s ) ;  
  
 	 	 	   f o r m . d a t a ( ' j q v ' ,   u s e r O p t i o n s ) ;  
 	 	 	   r e t u r n   u s e r O p t i o n s ;  
 	 	   } ,  
  
 	 	   / * *  
 	 	   *   R e m o v e s   f o r b i d d e n   c h a r a c t e r s   f r o m   c l a s s   n a m e  
 	 	   *   @ p a r a m   { S t r i n g }   c l a s s N a m e  
 	 	   * /  
 	 	   _ g e t C l a s s N a m e :   f u n c t i o n ( c l a s s N a m e )   {  
 	 	 	   i f ( c l a s s N a m e )  
 	 	 	 	   r e t u r n   c l a s s N a m e . r e p l a c e ( / : / g ,   " _ " ) . r e p l a c e ( / \ . / g ,   " _ " ) ;  
 	 	 	 	 	     } ,  
 	 	 / * *  
 	 	   *   E s c a p e   s p e c i a l   c h a r a c t e r   f o r   j Q u e r y   s e l e c t o r  
 	 	   *   h t t p : / / t o t a l d e v . c o m / c o n t e n t / e s c a p i n g - c h a r a c t e r s - g e t - v a l i d - j q u e r y - i d  
 	 	   *   @ p a r a m   { S t r i n g }   s e l e c t o r  
 	 	   * /  
 	 	   _ j q S e l e c t o r :   f u n c t i o n ( s t r ) {  
 	 	 	 r e t u r n   s t r . r e p l a c e ( / ( [ ; & , \ . \ + \ * \ ~ ' : " \ ! \ ^ # $ % @ \ [ \ ] \ ( \ ) = > \ | ] ) / g ,   ' \ \ $ 1 ' ) ;  
 	 	 } ,  
 	 	 / * *  
 	 	 *   C o n d i t i o n a l l y   r e q u i r e d   f i e l d  
 	 	 *  
 	 	 *   @ p a r a m   { j q O b j e c t }   f i e l d  
 	 	 *   @ p a r a m   { A r r a y [ S t r i n g ] }   r u l e s  
 	 	 *   @ p a r a m   { i n t }   i   r u l e s   i n d e x  
 	 	 *   @ p a r a m   { M a p }  
 	 	 *   u s e r   o p t i o n s  
 	 	 *   @ r e t u r n   a n   e r r o r   s t r i n g   i f   v a l i d a t i o n   f a i l e d  
 	 	 * /  
 	 	 _ c o n d R e q u i r e d :   f u n c t i o n ( f i e l d ,   r u l e s ,   i ,   o p t i o n s )   {  
 	 	 	 v a r   i d x ,   d e p e n d i n g F i e l d ;  
  
 	 	 	 f o r ( i d x   =   ( i   +   1 ) ;   i d x   <   r u l e s . l e n g t h ;   i d x + + )   {  
 	 	 	 	 d e p e n d i n g F i e l d   =   j Q u e r y ( " # "   +   r u l e s [ i d x ] ) . f i r s t ( ) ;  
  
 	 	 	 	 / *   U s e   _ r e q u i r e d   f o r   d e t e r m i n i n g   w e t h e r   d e p e n d i n g F i e l d   h a s   a   v a l u e .  
 	 	 	 	   *   T h e r e   i s   l o g i c   t h e r e   f o r   h a n d l i n g   a l l   f i e l d   t y p e s ,   a n d   d e f a u l t   v a l u e ;   s o   w e   w o n ' t   r e p l i c a t e   t h a t   h e r e  
 	 	 	 	   *   I n d i c a t e   t h i s   s p e c i a l   u s e   b y   s e t t i n g   t h e   l a s t   p a r a m e t e r   t o   t r u e   s o   w e   o n l y   v a l i d a t e   t h e   d e p e n d i n g F i e l d   o n   c h a c k b o x e s   a n d   r a d i o   b u t t o n s   ( # 4 6 2 )  
 	 	 	 	   * /  
 	 	 	 	 i f   ( d e p e n d i n g F i e l d . l e n g t h   & &   m e t h o d s . _ r e q u i r e d ( d e p e n d i n g F i e l d ,   [ " r e q u i r e d " ] ,   0 ,   o p t i o n s ,   t r u e )   = =   u n d e f i n e d )   {  
 	 	 	 	 	 / *   W e   n o w   k n o w   a n y   o f   t h e   d e p e n d i n g   f i e l d s   h a s   a   v a l u e ,  
 	 	 	 	 	   *   s o   w e   c a n   v a l i d a t e   t h i s   f i e l d   a s   p e r   n o r m a l   r e q u i r e d   c o d e  
 	 	 	 	 	   * /  
 	 	 	 	 	 r e t u r n   m e t h o d s . _ r e q u i r e d ( f i e l d ,   [ " r e q u i r e d " ] ,   0 ,   o p t i o n s ) ;  
 	 	 	 	 }  
 	 	 	 }  
 	 	 } ,  
  
 	         _ s u b m i t B u t t o n C l i c k :   f u n c t i o n ( e v e n t )   {  
 	                 v a r   b u t t o n   =   $ ( t h i s ) ;  
 	                 v a r   f o r m   =   b u t t o n . c l o s e s t ( ' f o r m ,   . v a l i d a t i o n E n g i n e C o n t a i n e r ' ) ;  
 	                 f o r m . d a t a ( " j q v _ s u b m i t B u t t o n " ,   b u t t o n . a t t r ( " i d " ) ) ;  
 	         }  
 	 	     } ;  
  
 	   / * *  
 	   *   P l u g i n   e n t r y   p o i n t .  
 	   *   Y o u   m a y   p a s s   a n   a c t i o n   a s   a   p a r a m e t e r   o r   a   l i s t   o f   o p t i o n s .  
 	   *   i f   n o n e ,   t h e   i n i t   a n d   a t t a c h   m e t h o d s   a r e   b e i n g   c a l l e d .  
 	   *   R e m e m b e r :   i f   y o u   p a s s   o p t i o n s ,   t h e   a t t a c h e d   m e t h o d   i s   N O T   c a l l e d   a u t o m a t i c a l l y  
 	   *  
 	   *   @ p a r a m   { S t r i n g }  
 	   *                         m e t h o d   ( o p t i o n a l )   a c t i o n  
 	   * /  
 	   $ . f n . v a l i d a t i o n E n g i n e   =   f u n c t i o n ( m e t h o d )   {  
  
 	 	   v a r   f o r m   =   $ ( t h i s ) ;  
 	 	   i f ( ! f o r m [ 0 ] )   r e t u r n   f o r m ;     / /   s t o p   h e r e   i f   t h e   f o r m   d o e s   n o t   e x i s t  
  
 	 	   i f   ( t y p e o f ( m e t h o d )   = =   ' s t r i n g '   & &   m e t h o d . c h a r A t ( 0 )   ! =   ' _ '   & &   m e t h o d s [ m e t h o d ] )   {  
  
 	 	 	   / /   m a k e   s u r e   i n i t   i s   c a l l e d   o n c e  
 	 	 	   i f ( m e t h o d   ! =   " s h o w P r o m p t "   & &   m e t h o d   ! =   " h i d e "   & &   m e t h o d   ! =   " h i d e A l l " )  
 	 	 	   m e t h o d s . i n i t . a p p l y ( f o r m ) ;  
  
 	 	 	   r e t u r n   m e t h o d s [ m e t h o d ] . a p p l y ( f o r m ,   A r r a y . p r o t o t y p e . s l i c e . c a l l ( a r g u m e n t s ,   1 ) ) ;  
 	 	   }   e l s e   i f   ( t y p e o f   m e t h o d   = =   ' o b j e c t '   | |   ! m e t h o d )   {  
  
 	 	 	   / /   d e f a u l t   c o n s t r u c t o r   w i t h   o r   w i t h o u t   a r g u m e n t s  
 	 	 	   m e t h o d s . i n i t . a p p l y ( f o r m ,   a r g u m e n t s ) ;  
 	 	 	   r e t u r n   m e t h o d s . a t t a c h . a p p l y ( f o r m ) ;  
 	 	   }   e l s e   {  
 	 	 	   $ . e r r o r ( ' M e t h o d   '   +   m e t h o d   +   '   d o e s   n o t   e x i s t   i n   j Q u e r y . v a l i d a t i o n E n g i n e ' ) ;  
 	 	   }  
 	 } ;  
  
  
  
 	 / /   L E A K   G L O B A L   O P T I O N S  
 	 $ . v a l i d a t i o n E n g i n e =   { f i e l d I d C o u n t e r :   0 , d e f a u l t s : {  
  
 	 	 / /   N a m e   o f   t h e   e v e n t   t r i g g e r i n g   f i e l d   v a l i d a t i o n  
 	 	 v a l i d a t i o n E v e n t T r i g g e r :   " b l u r " ,  
 	 	 / /   A u t o m a t i c a l l y   s c r o l l   v i e w p o r t   t o   t h e   f i r s t   e r r o r  
 	 	 s c r o l l :   t r u e ,  
 	 	 / /   F o c u s   o n   t h e   f i r s t   i n p u t  
 	 	 f o c u s F i r s t F i e l d : t r u e ,  
 	 	 / /   S h o w   p r o m p t s ,   s e t   t o   f a l s e   t o   d i s a b l e   p r o m p t s  
 	 	 s h o w P r o m p t s :   t r u e ,  
               / /   S h o u l d   w e   a t t e m p t   t o   v a l i d a t e   n o n - v i s i b l e   i n p u t   f i e l d s   c o n t a i n e d   i n   t h e   f o r m ?   ( U s e f u l   i n   c a s e s   o f   t a b b e d   c o n t a i n e r s ,   e . g .   j Q u e r y - U I   t a b s )  
               v a l i d a t e N o n V i s i b l e F i e l d s :   f a l s e ,  
 	 	 / /   O p e n i n g   b o x   p o s i t i o n ,   p o s s i b l e   l o c a t i o n s   a r e :   t o p L e f t ,  
 	 	 / /   t o p R i g h t ,   b o t t o m L e f t ,   c e n t e r R i g h t ,   b o t t o m R i g h t ,   i n l i n e  
 	 	 / /   i n l i n e   g e t s   i n s e r t e d   a f t e r   t h e   v a l i d a t e d   f i e l d   o r   i n t o   a n   e l e m e n t   s p e c i f i e d   i n   d a t a - p r o m p t - t a r g e t  
 	 	 p r o m p t P o s i t i o n :   " t o p R i g h t " ,  
 	 	 b i n d M e t h o d : " b i n d " ,  
 	 	 / /   i n t e r n a l ,   a u t o m a t i c a l l y   s e t   t o   t r u e   w h e n   i t   p a r s e   a   _ a j a x   r u l e  
 	 	 i n l i n e A j a x :   f a l s e ,  
 	 	 / /   i f   s e t   t o   t r u e ,   t h e   f o r m   d a t a   i s   s e n t   a s y n c h r o n o u s l y   v i a   a j a x   t o   t h e   f o r m . a c t i o n   u r l   ( g e t )  
 	 	 a j a x F o r m V a l i d a t i o n :   f a l s e ,  
 	 	 / /   T h e   u r l   t o   s e n d   t h e   s u b m i t   a j a x   v a l i d a t i o n   ( d e f a u l t   t o   a c t i o n )  
 	 	 a j a x F o r m V a l i d a t i o n U R L :   f a l s e ,  
 	 	 / /   H T T P   m e t h o d   u s e d   f o r   a j a x   v a l i d a t i o n  
 	 	 a j a x F o r m V a l i d a t i o n M e t h o d :   ' g e t ' ,  
 	 	 / /   A j a x   f o r m   v a l i d a t i o n   c a l l b a c k   m e t h o d :   b o o l e a n   o n C o m p l e t e ( f o r m ,   s t a t u s ,   e r r o r s ,   o p t i o n s )  
 	 	 / /   r e t u n s   f a l s e   i f   t h e   f o r m . s u b m i t   e v e n t   n e e d s   t o   b e   c a n c e l e d .  
 	 	 o n A j a x F o r m C o m p l e t e :   $ . n o o p ,  
 	 	 / /   c a l l e d   r i g h t   b e f o r e   t h e   a j a x   c a l l ,   m a y   r e t u r n   f a l s e   t o   c a n c e l  
 	 	 o n B e f o r e A j a x F o r m V a l i d a t i o n :   $ . n o o p ,  
 	 	 / /   S t o p s   f o r m   f r o m   s u b m i t t i n g   a n d   e x e c u t e   f u n c t i o n   a s s i c i a t e d   w i t h   i t  
 	 	 o n V a l i d a t i o n C o m p l e t e :   f a l s e ,  
  
 	 	 / /   U s e d   w h e n   y o u   h a v e   a   f o r m   f i e l d s   t o o   c l o s e   a n d   t h e   e r r o r s   m e s s a g e s   a r e   o n   t o p   o f   o t h e r   d i s t u r b i n g   v i e w i n g   m e s s a g e s  
 	 	 d o N o t S h o w A l l E r r o s O n S u b m i t :   f a l s e ,  
 	 	 / /   O b j e c t   w h e r e   y o u   s t o r e   c u s t o m   m e s s a g e s   t o   o v e r r i d e   t h e   d e f a u l t   e r r o r   m e s s a g e s  
 	 	 c u s t o m _ e r r o r _ m e s s a g e s : { } ,  
 	 	 / /   t r u e   i f   y o u   w a n t   t o   v i n d   t h e   i n p u t   f i e l d s  
 	 	 b i n d e d :   t r u e ,  
 	 	 / /   s e t   t o   t r u e ,   w h e n   t h e   p r o m p t   a r r o w   n e e d s   t o   b e   d i s p l a y e d  
 	 	 s h o w A r r o w :   t r u e ,  
 	 	 / /   d i d   o n e   o f   t h e   v a l i d a t i o n   f a i l   ?   k e p t   g l o b a l   t o   s t o p   f u r t h e r   a j a x   v a l i d a t i o n s  
 	 	 i s E r r o r :   f a l s e ,  
 	 	 / /   L i m i t   h o w   m a n y   d i s p l a y e d   e r r o r s   a   f i e l d   c a n   h a v e  
 	 	 m a x E r r o r s P e r F i e l d :   f a l s e ,  
 	 	  
 	 	 / /   C a c h e s   f i e l d   v a l i d a t i o n   s t a t u s ,   t y p i c a l l y   o n l y   b a d   s t a t u s   a r e   c r e a t e d .  
 	 	 / /   t h e   a r r a y   i s   u s e d   d u r i n g   a j a x   f o r m   v a l i d a t i o n   t o   d e t e c t   i s s u e s   e a r l y   a n d   p r e v e n t   a n   e x p e n s i v e   s u b m i t  
 	 	 a j a x V a l i d C a c h e :   { } ,  
 	 	 / /   A u t o   u p d a t e   p r o m p t   p o s i t i o n   a f t e r   w i n d o w   r e s i z e  
 	 	 a u t o P o s i t i o n U p d a t e :   f a l s e ,  
  
 	 	 I n v a l i d F i e l d s :   [ ] ,  
 	 	 o n F i e l d S u c c e s s :   f a l s e ,  
 	 	 o n F i e l d F a i l u r e :   f a l s e ,  
 	 	 o n S u c c e s s :   f a l s e ,  
 	 	 o n F a i l u r e :   f a l s e ,  
 	 	 v a l i d a t e A t t r i b u t e :   " c l a s s " ,  
 	 	 a d d S u c c e s s C s s C l a s s T o F i e l d :   " " ,  
 	 	 a d d F a i l u r e C s s C l a s s T o F i e l d :   " " ,  
 	 	  
 	 	 / /   A u t o - h i d e   p r o m p t  
 	 	 a u t o H i d e P r o m p t :   f a l s e ,  
 	 	 / /   D e l a y   b e f o r e   a u t o - h i d e  
 	 	 a u t o H i d e D e l a y :   1 0 0 0 0 ,  
 	 	 / /   F a d e   o u t   d u r a t i o n   w h i l e   h i d i n g   t h e   v a l i d a t i o n s  
 	 	 f a d e D u r a t i o n :   0 . 3 ,  
 	   / /   U s e   P r e t t i f y   s e l e c t   l i b r a r y  
 	   p r e t t y S e l e c t :   f a l s e ,  
 	   / /   A d d   c s s   c l a s s   o n   p r o m p t  
 	   a d d P r o m p t C l a s s   :   " " ,  
 	   / /   C u s t o m   I D   u s e s   p r e f i x  
 	   u s e P r e f i x :   " " ,  
 	   / /   C u s t o m   I D   u s e s   s u f f i x  
 	   u s e S u f f i x :   " " ,  
 	   / /   O n l y   s h o w   o n e   m e s s a g e   p e r   e r r o r   p r o m p t  
 	   s h o w O n e M e s s a g e :   f a l s e  
 	 } } ;  
 	 $ ( f u n c t i o n ( ) { $ . v a l i d a t i o n E n g i n e . d e f a u l t s . p r o m p t P o s i t i o n   =   m e t h o d s . i s R T L ( ) ? ' t o p L e f t ' : " t o p R i g h t " } ) ;  
 } ) ( j Q u e r y ) ;  
  
  
 